<?php

declare(strict_types=1);

namespace app\controllers;

use Yii;
use app\models\ContactForm;
use app\models\LoginForm;
use yii\captcha\CaptchaAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\base\Security;
use yii\mail\MailerInterface;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\Response;

class SiteController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly MailerInterface $mailer,
        private readonly Security $security,
        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'request-editor' => ['post'], 
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'transparent' => true,
            ],
        ];
    }

    /**
     * Displays homepage.
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * Login action.
     */
    public function actionLogin(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index']); 
        }

        $model = new LoginForm($this->security);

        if ($model->load($this->request->post()) && $model->login()) {
            return $this->redirect(['index']);
        }

        $model->password = '';

        return $this->render('login', ['model' => $model]);
    }

    /**
     * Signup action.
     */
    public function actionSignup()
    {
        $model = new \app\models\UserAccounts();

        if ($model->load(Yii::$app->request->post())) {
            
            $czysteHaslo = $model->password;
            $model->password = password_hash($czysteHaslo, PASSWORD_DEFAULT);
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Konto zostało pomyślnie utworzone! Możesz się zalogować.');
                return $this->redirect(['login']);
            } else {
                $model->password = $czysteHaslo;
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Obsługa prośby o nadanie uprawnień Edytora.
     */
    public function actionRequestEditor()
    {
        // Jeśli ktoś wchodzi bez logowania, odrzucamy
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }

        $userId = Yii::$app->user->id;

        // SPRAWDZENIE: Czy użytkownik ma już jakieś zgłoszenie w bazie?
        $istniejaceZgloszenie = \app\models\EditorRequests::findOne(['user_id' => $userId]);

        if ($istniejaceZgloszenie) {
            // Jeśli zgłoszenie już istnieje, wyświetlamy informację i przerywamy proces
            Yii::$app->session->setFlash('info', 'Masz już aktywne zgłoszenie. Cierpliwie czekaj na decyzję administratora.');
            return $this->redirect(['index']);
        }

        // Jeśli zgłoszenia nie ma, tworzymy nowe
        $model = new \app\models\EditorRequests();
        $model->user_id = $userId; 
        
        // Zapisujemy używając standardowego save() z walidacją
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Twoja prośba została pomyślnie wysłana! Oczekuj na akceptację przez administratora.');
        } else {
            Yii::$app->session->setFlash('error', 'Wystąpił błąd podczas wysyłania prośby.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Logout action.
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     */
    public function actionContact(): Response|string
    {
        $model = new ContactForm();

        $contact = $model->load($this->request->post()) && $model->contact(
            $this->mailer,
            Yii::$app->params['adminEmail'],
            Yii::$app->params['senderEmail'],
            Yii::$app->params['senderName'],
        );

        if ($contact) {
            Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            return $this->refresh();
        }

        return $this->render('contact', ['model' => $model]);
    }

    /**
     * Displays about page.
     */
    public function actionAbout(): string
    {
        return $this->render('about');
    }
    /**
     * Akcja resetowania hasła za pomocą pytania pomocniczego
     */
    public function actionResetPassword()
    {
        $username = Yii::$app->request->post('username');
        $answer = Yii::$app->request->post('answer');
        $new_password = Yii::$app->request->post('new_password');
        
        $user = null;
        $error = null;

        // Jeśli wysłano login
        if ($username) {
            $user = \app\models\UserAccounts::findOne(['username' => $username]);
            
            if (!$user) {
                $error = 'Nie znaleziono użytkownika o takim loginie.';
            } 
            // Jeśli wysłano już odpowiedź i nowe hasło
            elseif ($answer && $new_password) {
                // Sprawdzamy, czy odpowiedź pasuje do zaszyfrowanej odpowiedzi w bazie
                if (password_verify($answer, $user->security_answer)) {
                    $user->password = $new_password; // Przypisujemy czyste hasło
                    $user->save(false); // Zapisujemy, a funkcja beforeSave w modelu automatycznie je zaszyfruje!
                    
                    Yii::$app->session->setFlash('success', 'Hasło zostało pomyślnie zmienione! Możesz się teraz zalogować.');
                    return $this->redirect(['login']);
                } else {
                    $error = 'Błędna odpowiedź na pytanie pomocnicze.';
                }
            }
        }

        return $this->render('reset-password', [
            'user' => $user,
            'error' => $error,
        ]);
    }
}