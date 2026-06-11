# System Zarządzania Klientami i Uprawnieniami (Yii2)

Projekt zaliczeniowy z wykorzystaniem frameworka Yii2. Aplikacja posiada system logowania, autoryzację opartą na rolach (RBAC) oraz pełny system CRUD z relacyjną bazą danych.

## Autor

- **Sławomir Budziński**
- **GrupaAMPI**

## Wymagania

- PHP 8.0+
- MySQL (XAMPP)
- Composer

## Instrukcja uruchomienia

## Instrukcja uruchomienia (dla Wykładowcy - środowisko XAMPP)

1. Uruchom panel kontrolny **XAMPP** i włącz moduły **Apache** oraz **MySQL**.
2. Sklonuj to repozytorium (lub wypakuj plik ZIP) bezpośrednio do folderu serwera, domyślnie: `C:\xampp\htdocs\yii2_app` (lub pod inną nazwą folderu).
3. Otwórz terminal wewnątrz folderu projektu i uruchom polecenie:
   `composer install`
   _(Instaluje ono wymagane zależności i brakujący folder `vendor`)._
4. Przejdź w przeglądarce pod adres `http://localhost/phpmyadmin`.
5. Utwórz nową bazę danych (upewnij się, że nazwa zgadza się z konfiguracją z punktu 7).
6. Zaimportuj do nowej bazy plik `baza_projekt.sql` znajdujący się w głównym folderze projektu.
7. W razie potrzeby zaktualizuj dane logowania do bazy w pliku `config/db.php`.
8. **Uruchomienie aplikacji:** Otwórz przeglądarkę i wpisz adres:
   👉 `http://localhost/yii2_app/web/`
   _(Jeśli zmieniłeś nazwę głównego folderu w kroku 2, dostosuj ten link)._

## Konta testowe

W systemie utworzono następujące konta do testowania różnych ról:

- **Administrator:** login: `admin` | hasło: `admin`
- **Edytor:** login: `Edytor` | hasło: `Edytor`
- **Widz:** login: `Widz` | hasło: `Widz`

## Główne funkcjonalności

- **CRUD Użytkowników (Panel Admina):** Pełne zarządzanie kontami, automatyczne bezpieczne szyfrowanie haseł (`password_hash` z solą), ukrywanie wrażliwych danych i możliwość resetowania haseł przez administratora.
- **CRUD Klientów:** Zarządzanie bazą kontrahentów, zaimplementowane bezpieczne sprawdzanie uprawnień (widoczność przycisków edycji/usuwania zależy od roli zalogowanego użytkownika).
- **Automatyzacja procesów (Behaviors):** Wykorzystanie wbudowanych mechanizmów Yii2 (`TimestampBehavior` oraz `BlameableBehavior`) do automatycznego zapisywania czasu akcji oraz ID użytkownika, który dodał lub zmodyfikował klienta.
- **System prośby o uprawnienia (Workflow):** Możliwość wysyłania przez "Widza" zgłoszeń o wyższą rolę. Administrator po zatwierdzeniu wniosku automatycznie awansuje konto do roli "Edytora".
- **Odzyskiwanie dostępu:** Autorski mechanizm resetowania hasła na ekranie logowania za pomocą weryfikacji pytania pomocniczego i bezpiecznie zaszyfrowanej odpowiedzi.
