# use with model pkg 

# with module create
php artisan module:make Blog

# use this command to create database or model
php artisan module:make-model Lead Lead -m

# for request
php artisan module:make-request AuthRequest Auth

# for event 
php artisan module:make-event UserRegistered User
php artisan module:make-listener SendWelcomeEmail User

email :- support@@wokkai.com
password :- h%D0hJjVabPDECox



Mail Client Manual Settings
    Secure SSL/TLS Settings (Recommended)
    Username:	support@wokkai.com
    Password:	Use the email account's password.
    Incoming Server:	mail.wokkai.com
    IMAP Port: 993 POP3 Port: 995
    Outgoing Server:	mail.wokkai.com
    SMTP Port: 465
    IMAP, POP3, and SMTP require authentication.

Calendar & Contacts Manual Settings
    Secure SSL/TLS Settings (Recommended).
    Username:	support@wokkai.com
    Password:	Use the email account's password.
    Server:	https://mail.wokkai.com:2080
    Port: 2080
    Full Calendar URL(s):	
    cPanel CalDAV Calendar: https://mail.wokkai.com:2080/calendars/support@wokkai.com/calendar
    Full Contact List URL(s):	
    cPanel CardDAV Address Book: https://mail.wokkai.com:2080/addressbooks/support@wokkai.com/addressbook

Non-SSL Settings (NOT Recommended).
    Username:	support@wokkai.com
    Password:	Use the email account's password.
    Server:	http://mail.wokkai.com:2079
    Port: 2079
    Full Calendar URL(s):	
    cPanel CalDAV Calendar: http://mail.wokkai.com:2079/calendars/support@wokkai.com/calendar
    Full Contact List URL(s):	
    cPanel CardDAV Address Book: http://mail.wokkai.com:2079/addressbooks/support@wokkai.com/addressbook
