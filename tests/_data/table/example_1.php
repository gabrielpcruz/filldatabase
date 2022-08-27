<?php

return [
    'sulphur' => [
        'Field' => 'sulphur',
        'Type' => 'int(11) unsigned',
        'Null' => 'NO',
        'Key' => 'PRI',
        'Default' => 'null',
        'Extra' => 'auto_increment',
    ],

    'climb' => [
        'Field' => 'climb',
        'Type' => 'int(11) unsigned',
        'Null' => 'YES',
        'Key' => 'MUL',
        'Default' => 'null',
        'Extra' => '',
    ],

    'gradual' => [
        'Field' => 'gradual',
        'Type' => 'int(11)',
        'Null' => 'YES',
        'Key' => 'MUL',
        'Default' => 'null',
        'Extra' => '',
    ],

    'wrist' => [
        'Field' => 'wrist',
        'Type' => 'varchar(45)',
        'Null' => 'YES',
        'Key' => 'MUL',
        'Default' => 'null',
        'Extra' => '',
    ],

    'march' => [
        'Field' => 'march',
        'Type' => 'datetime',
        'Null' => 'YES',
        'Key' => 'MUL',
        'Default' => 'null',
        'Extra' => '',
    ],

    'muggy' => [
        'Field' => 'muggy',
        'Type' => 'datetime',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'menu' => [
        'Field' => 'menu',
        'Type' => 'varchar(45)',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'finished' => [
        'Field' => 'finished',
        'Type' => 'varchar(255)',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'formula' => [
        'Field' => 'formula',
        'Type' => 'longtext',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'memorandum' => [
        'Field' => 'memorandum',
        'Type' => 'longtext',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'appetite' => [
        'Field' => 'appetite',
        'Type' => 'varchar(45)',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'computing' => [
        'Field' => 'computing',
        'Type' => 'varchar(255)',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'band' => [
        'Field' => 'band',
        'Type' => 'varchar(255)',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'pace' => [
        'Field' => 'pace',
        'Type' => 'varchar(45)',
        'Null' => 'YES',
        'Key' => 'MUL',
        'Default' => 'null',
        'Extra' => '',
    ],

    'discipline' => [
        'Field' => 'discipline',
        'Type' => 'varchar(45)',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'security' => [
        'Field' => 'security',
        'Type' => 'varchar(45)',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'employ' => [
        'Field' => 'employ',
        'Type' => 'text',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'campaign' => [
        'Field' => 'campaign',
        'Type' => 'text',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'chocolate' => [
        'Field' => 'chocolate',
        'Type' => 'text',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'proposal' => [
        'Field' => 'proposal',
        'Type' => 'tinyint(1)',
        'Null' => 'YES',
        'Key' => 'MUL',
        'Default' => 'null',
        'Extra' => '',
    ],

    'add' => [
        'Field' => 'add',
        'Type' => 'tinyint(1)',
        'Null' => 'YES',
        'Key' => 'MUL',
        'Default' => 'null',
        'Extra' => '',
    ],

    'default' => [
        'Field' => 'default',
        'Type' => 'tinyint(1)',
        'Null' => 'YES',
        'Key' => '',
        'Default' => 'null',
        'Extra' => '',
    ],

    'senior' => [
        'Field' => 'senior',
        'Type' => 'tinyint(1)',
        'Null' => 'NO',
        'Key' => '',
        'Default' => 0,
        'Extra' => '',
    ],
];