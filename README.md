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

1. Sklonuj repozytorium do swojego folderu serwera (np. `htdocs`).
2. Otwórz terminal w folderze projektu i uruchom polecenie:
   `composer install` (aby pobrać folder vendor).
3. W phpMyAdmin utwórz nową bazę danych (np. `yii2_baza`).
4. Zaimportuj do niej plik `my_app.sql` dołączony do głównego folderu.
5. Skonfiguruj połączenie z bazą w pliku `config/db.php`.

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
