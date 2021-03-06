<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;
use \App\Model\Entity\Videos as EntityVideos;

class Watch extends Page{
    /**
     * Método responsável por retornar o conteúdo (view) da nossa Home
     * @return string
     */
    public static function getWatch($codeVideo){
        //Organização
        $obOrganization = new Organization;

        if(isset($codeVideo) && $codeVideo != '' && $codeVideo != null){
            $results = EntityVideos::getVideos(null,'video');
            
            while($obUser = $results->fetchObject(EntityVideos::class)){
                if(trim($codeVideo) == trim($obUser->video)){
                    $title = $obUser->title;
                    $description = $obUser->description;
                    $channel = $obUser->channel;
                    $thumbnail = $obUser->thumbnail;
                    $video = $obUser->video;
                    $date = $obUser->date;
                }
            }
        }

        //VIEW DA HOME
        $content = View::render('pages/watch',[
            'title' => $title,
            'description' => $description,
            'video' => $video
        ]);

        //Título do vídeo com ellipsis
        $pageTitle = strlen($title) > 30 ? substr($title,0,30)."..." : $title;

        //RETORNA A VIEW DA PÁGINA
        return parent::getPage(
            //NOME DE ARQUIVOS CSS,JS...
            'watch',
            //TITLE DA PÁGINA
            $pageTitle.' - '.$obOrganization->name,
            //DESCRIÇÃO DA PÁGINA
            'Bem-vindos ao RiftMaker.com - Análise as estatísticas de invocadores, melhores campeões, ranking competitivo, times de Clash, Profissionais e muito mais',
            //CONTEUDO DA PÁGINA
            $content
        );
    }

}