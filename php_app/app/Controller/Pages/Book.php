<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Book extends Page
{

    /** metodo para resgatar os dados da pagina de livros (view)
     * @return string
     *  */
    public static function getBook()
    {

        $content = View::render('pages/list/listBooks', [
            //view books
            'id' => '1',
            'titule' => 'bela e a fera',
            'page' => '1982',
            'realese_date' => '1970',
            'authors_name' => 'beneditor',
            'publishers_name' => 'editora ld',
        ]);

        //retorna a view da pagina
        return parent::getPage('Listagem de Livros', $content);
    }

    /** metodo para realizar update dos dados da pagina de livro (view)
     * @return string
     *  */
    public static function getUpdateBook()
    {


        $content = View::render('pages/update/updateBook', [
            //view book
            'id' => '1',
            'name' => 'benedito',
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Livro', $content);
    }
}
