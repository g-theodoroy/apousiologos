# Ηλ. απουσιολόγος

## Σκοπός: 

- Η καταγραφή των απουσιών των μαθητών κάθε ώρα σε **πραγματικό χρόνο**.
- Άμεση **εποπτεία** των απόντων μαθητών από την 1η ώρα και κάθε ώρα.
- **Εισαγωγή των απουσιών στο myschool** άμα τη λήξη των μαθημάτων (εξαγωγή αρχείου xls).

## Εγκατάσταση

#### linux terminal

```
git clone https://github.com/g-theodoroy/apousiologos.git
cd apousiologos/
composer install --no-dev
chmod -R 0777 storage/
```

#### windows

Κατεβάστε το zip:

https://github.com/g-theodoroy/apousiologos/archive/main.zip

Αποσυμπιέστε και με το **cmd** πηγαίνετε στον φάκελο και τρέξτε:
```
composer install --no-dev
```

Φυσικά θα πρέπει να έχετε εγκατεστημένη την **php** και τον **composer**

https://devanswers.co/install-composer-php-windows-10/

Αν θέλετε να ρυθμίσετε αποστολή **email** συμπληρώστε κατάλληλα στο αρχείο **.env**:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=xxxxxxxxxx
MAIL_PASSWORD=xxxxxxxxxx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=xxxxxxxxxx
MAIL_FROM_NAME="${APP_NAME}"
```

**Ανεβάστε τον φάκελο στον server**


## Ρύθμιση - χρήση

[Οδηγίες ρύθμισης κ χρήσης Ηλ.Απουσιολόγου.pdf](https://github.com/g-theodoroy/apousiologos/blob/main/public/files/%CE%9F%CE%B4%CE%B7%CE%B3%CE%AF%CE%B5%CF%82%20%CF%81%CF%8D%CE%B8%CE%BC%CE%B9%CF%83%CE%B7%CF%82%20%CE%BA%20%CF%87%CF%81%CE%AE%CF%83%CE%B7%CF%82%20%CE%97%CE%BB.%CE%91%CF%80%CE%BF%CF%85%CF%83%CE%B9%CE%BF%CE%BB%CF%8C%CE%B3%CE%BF%CF%85.pdf)


# GΘ@2020



