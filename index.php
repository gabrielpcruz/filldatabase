<?php


require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager;
// use Illuminate\Support\Facades\DB;

Manager::schema()->dropIfExists('contratado');
Manager::schema()->dropIfExists('contato');
Manager::schema()->dropIfExists('area');
Manager::schema()->dropIfExists('usuario');



Manager::schema()->create('usuario', function($table)
{
    $table->increments('id');
    $table->string('login', 50);
    $table->string('senha', 250);
    $table->string('img', 250);
});

Manager::schema()->create('area', function($table)
{
    $table->increments('id');
    $table->string('descricao', 100);
});

Manager::schema()->create('contato', function($table)
{
    $table->increments('id');
    $table->string('email', 100)->nullable();
    $table->string('telefone1', 11);
    $table->string('telefone2', 11)->nullable();
});

Manager::schema()->create('contratado', function($table)
{
    $table->increments('id');
    $table->string('nome', 100);
    $table->integer('usuario_id')->unsigned();
    $table->integer('contato_id')->unsigned();
    $table->integer('area_id')->unsigned();
    $table->foreign('usuario_id')->references('id')->on('usuario');
    $table->foreign('contato_id')->references('id')->on('contato');
    $table->foreign('area_id')->references('id')->on('area');
});

Manager::insert('insert into usuario (id, login, senha, img) values (?, ?, ?, ?)', [null, "joao", "123456", "https://s3.amazonaws.com/kp-blog/wp-content/uploads/2018/06/18094614/marketing-digital-para-empreendedores-como-aplicar-na-sua-empresa.jpg"]);
Manager::insert('insert into usuario (id, login, senha, img) values (?, ?, ?, ?)', [null, "jose", "123456", "https://mgodoi.com.br/wp-content/themes/mgodoi/assets/images/otimizadas/img-01-2.jpg"]);
Manager::insert('insert into usuario (id, login, senha, img) values (?, ?, ?, ?)', [null, "luiz", "123456", "http://blog.seguridade.com.br/wp-content/uploads/2016/12/saiba-como-terceirizar-os-servicos-gerais-da-empresa-810x541.jpeg"]);
Manager::insert('insert into usuario (id, login, senha, img) values (?, ?, ?, ?)', [null, "paulo", "123456", "https://blog.arsys.es/wp-content/uploads/2017/12/startup-empresa.jpg"]);
Manager::insert('insert into usuario (id, login, senha, img) values (?, ?, ?, ?)', [null, "maria", "123456", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT21e-brw2a3hrg0rF0C28sur80CCJKug4TduKamIpsBLmFt_nHVw"]);
Manager::insert('insert into usuario (id, login, senha, img) values (?, ?, ?, ?)', [null, "zeca", "123456", "https://www.superempreendedores.com/wp-content/uploads/2017/09/Quais-Vantagens-e-Desvantagens-de-se-Abrir-uma-Empresa-Limitada.jpg"]);
Manager::insert('insert into usuario (id, login, senha, img) values (?, ?, ?, ?)', [null, "xena", "123456", "http://63.143.48.211/imagens/93/whatsapp-business-no-brasil-como-configurar-o-perfil-da-sua-empresa_2612018165000.jpg"]);

Manager::insert('insert into area (id, descricao) values (?, ?)', [null, "Construção Civil"]);
Manager::insert('insert into area (id, descricao) values (?, ?)', [null, "Administração"]);
Manager::insert('insert into area (id, descricao) values (?, ?)', [null, "Desing"]);
Manager::insert('insert into area (id, descricao) values (?, ?)', [null, "Informática"]);
Manager::insert('insert into area (id, descricao) values (?, ?)', [null, "Móveis"]);


Manager::insert('insert into contato (id, email, telefone1) values (?, ?, ?)', [null, "email@gmail.com", "61995830718"]);
Manager::insert('insert into contato (id, email, telefone1) values (?, ?, ?)', [null, "email2@gmail.com", "61995500374"]);
Manager::insert('insert into contato (id, email, telefone1) values (?, ?, ?)', [null, "email3@gmail.com", "61999999356"]);
Manager::insert('insert into contato (id, email, telefone1) values (?, ?, ?)', [null, "email4@gmail.com", "61999485999"]);
Manager::insert('insert into contato (id, email, telefone1) values (?, ?, ?)', [null, "email5@gmail.com", "61999968999"]);
Manager::insert('insert into contato (id, email, telefone1) values (?, ?, ?)', [null, "email6@gmail.com", "61999243599"]);
Manager::insert('insert into contato (id, email, telefone1) values (?, ?, ?)', [null, "email7@gmail.com", "61999873459"]);


Manager::insert('insert into contratado (id, nome, usuario_id, contato_id, area_id) values (?, ?, ?, ?, ?)', [null, "Serviços LTDA", 1, 1, 1]);
Manager::insert('insert into contratado (id, nome, usuario_id, contato_id, area_id) values (?, ?, ?, ?, ?)', [null, "Sghh  ", 2, 2, 2]);
Manager::insert('insert into contratado (id, nome, usuario_id, contato_id, area_id) values (?, ?, ?, ?, ?)', [null, "Shgfh ghanejados", 3, 3, 3]);
Manager::insert('insert into contratado (id, nome, usuario_id, contato_id, area_id) values (?, ?, ?, ?, ?)', [null, "Sãogfh gfos", 4, 4, 4]);
Manager::insert('insert into contratado (id, nome, usuario_id, contato_id, area_id) values (?, ?, ?, ?, ?)', [null, "São Ragh fghejados", 5, 5, 3]);
Manager::insert('insert into contratado (id, nome, usuario_id, contato_id, area_id) values (?, ?, ?, ?, ?)', [null, "São Rgfh imagefontwidths Planejados", 6, 6, 3]);
Manager::insert('insert into contratado (id, nome, usuario_id, contato_id, area_id) values (?, ?, ?, ?, ?)', [null, "São Rafghjados", 7, 7, 2]);
