<?php

namespace App\Controller\Pages\Delete;

use \App\Utils\View;
use \App\Model\Entity\Book as EntityBook;
use \App\Controller\Pages\Client\Alert;
use \App\Controller\Pages\Read\Page;


class Book extends Page
{

     /**
     * método responsável por retornar a mensagem de status
     * @param request $request
     * @return string
     */
    private static function getStatus($request)
    {
        //query params
        $queryParamns = $request->getQueryParams();

        //status
        if (!isset($queryParamns['status'])) return '';

        //Mensagem de Status
        switch ($queryParamns['status']) {
            case 'created':
                return Alert::getSuccess('Autor criado com sucesso!');
                break;
            case 'updated':
                return Alert::getSuccess('Autor atualizado com sucesso!');
                break;
            case 'deleted':
                return Alert::getSuccess('Autor deletado com sucesso!');
                break;
        }
    }


    /** metodo para realizar exclusão dos dados da pagina de livros
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function getDeleteBook($request, $id)
    {
        //obtem os dados de livros no banco de dados
        $obBook = EntityBook::getBookById($id);

        //valida a instancia
        if (!$obBook instanceof EntityBook) {
            $request->getRouter()->redirect('/book');
        }

        //redenrizar pagina de delete
        $content = View::render('/pages/delete/deleteBook', [
            //view Books
            'tipo' => 'livro',
            'titule' => 'Confirmar exclusão',
            'id' => $obBook->id,
            'title' => $obBook->titule,
            'page' => $obBook->page,
            'realese_date' => $obBook->realese_date,
            'status' => self::getStatus($request)
        ]);

        //retorna a view da pagina
        return parent::getPageHome('Confirmar de exclusão autor', $content);
    }

    /** metodo para realizar exclusão dos dados da pagina de livros (view)
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setDeleteBook($request, $id)
    {
       

        //obtem os dados de livros no banco de dados
        $obBook = EntityBook::getBookById($id);
        
        //valida a instancia
        if (!$obBook instanceof EntityBook) {
            $request->getRouter()->redirect('/book');
        }

        //excluir livros
        $obBook->excluir($id);

        //redireciona para editagem
        $request->getRouter()->redirect('/book?status=deleted');
    }
    
}
