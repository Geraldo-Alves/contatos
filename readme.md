*Instalação*

    git clone https://github.com/Geraldo-Alves/contatos.git
    cd contatos
    composer install


*Banco*

    Configuração do arquivo .env
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate


*Especificações*

Aplicação com dois CRUDS

    CRUD - Contatos
        [create] => SymfonyForm;
            method: POST
        [update] => Angular / API;
            method: PUT
        [read] => Twig
            method: GET
        [delete] =>
            method: DELETE

    CRUD - Endereços
        [create] => HTML form;
            method: POST
        [update] => Angular / API;
            method: PUT
        [read] => Twig
            method: GET
        [delete] =>
            method: DELETE

Obs: As entidades foram todas criadas utilizando-se o Doctrine, através do comando:

    php bin/console make:entity
