export SYMFONY_DEBUG=0
export SYMFONY_ENV="prod"
git clone https://github.com/upMKuhn/trivagoC2.git
cd trivagoC2

composer install --no-dev --optimize-autoloader -n
php bin/symfony_requirements --env=prod --no-debug

php bin/console doctrine:migrations:migrate --env=prod --no-debug -q


php bin/console cache:clear --env=prod --no-debug --no-warmup
php bin/console cache:warmup --env=prod --no-debug


git clone https://github.com/upMKuhn/trivagoC2-frontEnd.git
cd trivagoC2-frontEnd
npm run-script build --prod
cp dist ../web

 


