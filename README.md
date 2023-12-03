## Install MAMP

## Install composer

Add php to path

```
nano ~/.bashrc
export PATH=/Applications/MAMP/bin/php/php8.2.0/bin:$PATH
```


```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php --install-dir=bin
php -r "unlink('composer-setup.php');"
```

## Install dependencies

```
php bin/composer.phar install
php bin/composer.phar dump-autoload
```

When there is a change in namespace, re-run dump-autoload

## Setup variables

Copy .env.example to .env, 
Edit corresponding variables

