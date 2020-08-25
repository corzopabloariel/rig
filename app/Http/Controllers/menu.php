<?php
define("PAGINATE", 15);

define("MENU",
    [
        [
            "id" => "home",
            "name" => "Home",
            "icon" => "nav-pyrus__icon fas fa-home",
            "urls" => [\URL::to("root"), \URL::to("root/helps"), \URL::to("root/labels"), \URL::to('root/images')],
            "submenu" => [
                [
                    "name" => "Inicio",
                    "icon" => "nav-pyrus__icon fab fa-trello",
                    "url" => \URL::to("root"),
                ], [
                    "name" => "Ayudas",
                    "icon" => "nav-pyrus__icon fas fa-question-circle",
                    "url" => \URL::to("root/helps"),
                ], [
                    "name" => "Rótulos",
                    "icon" => "nav-pyrus__icon fas fa-tag",
                    "url" => \URL::to("root/labels"),
                ], [
                    "name" => "Imágenes",
                    "icon" => "nav-pyrus__icon far fa-images",
                    "url" => \URL::to('root/images')
                ]
            ]
        ], [
            "separar" => 1
        ], [
            "id" => "operaciones",
            "name" => "Operaciones",
            "icon" => "nav-pyrus__icon fab fa-redhat",
            "url" => \URL::to("root/operations")
        ], [
            "id" => "declaraciones",
            "name" => "Declaraciones",
            "icon" => "nav-pyrus__icon fas fa-spell-check",
            "url" => \URL::to("root/declaraciones")
        ], [
            "id" => "textos",
            "name" => "Textos",
            "icon" => "nav-pyrus__icon fas fa-file-alt",
            "url" => \URL::to("root/texts")
        ], [
            "separar" => 1
        ], [
            "id" => "usuarios",
            "name" => "Usuarios",
            "icon" => "nav-pyrus__icon fas fa-users",
            "url" => \URL::to("root/users")
        ], [
            "id" => "clientes",
            "name" => "Clientes",
            "icon" => "nav-pyrus__icon fas fa-user-tie",
            "url" => \URL::to("root/clients")
        ], [
            "id" => "formulario",
            "name" => "Formulario",
            "icon" => "nav-pyrus__icon fab fa-wpforms",
            "url" => \URL::to("root/forms")
        ]
    ]
);

define("MENU_ADM",
    [
        [
            "id" => "declaraciones",
            "name" => "Declaraciones",
            "icon" => "nav-pyrus__icon fas fa-spell-check",
            "url" => \URL::to("root/declaraciones")
        ]
    ]
);