<?php

namespace App\Controller\Pages\Read;

use \App\Utils\View;
use \App\Model\Entity\Costumer as EntityCostumer;


class Costumer extends Page
{

    private function getCostumerItems()
    {
        // dados do usuario
        $itens = '';

        // resultados da pagina
        $results = EntityCostumer::getCostumer(null, 'id ASC');

        // renderiza o item
        while ($obCostumer = $results->fetchObject(EntityCostumer::class)) {
            $itens .= View::render('pages/list/costumer/item', [
                'id' => $obCostumer->id,
                'name' => $obCostumer->name,
                'cpf' => $obCostumer->cpf,
                'phone_number' => $obCostumer->phone_number,
                'address' => $obCostumer->address,
                'email' => $obCostumer->email,
            ]);
        }
        //retorna os dados
        return $itens;
    }

    /** metodo para resgatar os dados da pagina de consumidores (view)
     * @return string
     *  */
    public static function getCostumer($request)
    {

        $content = View::render('pages/list/listCostumers', [
            //view costumers
            'item' => self::getCostumerItems(),
        ]);


        //retorna a view da pagina
        return parent::getPage('Listagem de Usuarios', $content);
    }

    /** metodo para realizar update dos dados da pagina de usuario (view)
     * @return string
     *  */
    public static function getUpdateCostumer($request, $id)
    {
        //obtem os dados de usuarios no banco de dados
        $obCostumer = EntityCostumer::getCostumerById($id);

        //valida a instancia
        if (!$obCostumer instanceof EntityCostumer) {
            $request->getRouter()->redirect('/costumer');
        }

        $content = View::render('pages/update/updateCostumer', [
            //view costumer
            'id' => $obCostumer->id,
            'name' => $obCostumer->name,
            'cpf' => $obCostumer->cpf,
            'phone_number' => $obCostumer->phone_number,
            'address' => $obCostumer->address,
            'email' => $obCostumer->email,
        ]);

        //retorna a view da pagina
        return parent::getPage('Editagem de Usuario', $content);
    }

     /** metodo para realizar update dos dados da pagina de consumidor (view)
     * @return string
     * @param integer $id
     * @param Request $request
     * 
     *  */
    public static function setUpdateCostumer($request, $id)
    {
        //obtem os dados de livros no banco de dados
        $obCostumer = EntityCostumer::getCostumerById($id);

        //valida a instancia
        if (!$obCostumer instanceof EntityCostumer) {
            $request->getRouter()->redirect('/costumer');
        }

        //post vars
        $postVars = $request->getPostVars();

        //atualiza a instancia
        $obCostumer->name = $postVars['name'] ?? $obCostumer->name;
        $obCostumer->cpf = $postVars['cpf'] ?? $obCostumer->cpf;
        $obCostumer->phone_number = $postVars['phone_number'] ?? $obCostumer->phone_number;
        $obCostumer->address = $postVars['address'] ?? $obCostumer->address;
        $obCostumer->email = $postVars['email'] ?? $obCostumer->email;
        
        $obCostumer->atualizar();


        //redireciona para editagem
        $request->getRouter()->redirect('/'. 'updateCostumer/'.$obCostumer->id.'/edit?status=updated');
    }
}
