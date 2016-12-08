# Website https://haus23.net

## Databases

### DTP

    ./bin/console doctrine:database:create --connection=dtp
    ./bin/console doctrine:generate:entities --path src AppBundle/Entity/DTP
    ./bin/console doctrine:schema:update --dump-sql --em dtp --force

