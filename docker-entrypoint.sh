#!/bin/bash

# Ako .env ne postoji u Laravel folderu, kopiraj ga iz .env.example
if [ ! -f /var/www/html/PregledLicnihFinansija/.env ]; then
    echo "Kreiram .env fajl..."
    cp /var/www/html/PregledLicnihFinansija/.env.example /var/www/html/PregledLicnihFinansija/.env
fi

# Generiši Laravel ključ ako već nije postavljen
cd /var/www/html/PregledLicnihFinansija
if ! grep -q "APP_KEY=base64" .env; then
    echo "Generišem Laravel APP_KEY..."
    php artisan key:generate
fi

# Pokreni zvaničnu Apache komandu u pozadini
exec apache2-foreground