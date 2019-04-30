<?php

namespace App\Service;

use App\App;
use App\Service\ApplicationContext;
use App\Model\Entity\Quote;
use App\Model\EntityManager\QuoteRepository;
use App\Model\EntityManager\SiteRepository;
use App\Model\EntityManager\DestinationRepository;

class AbstractTemplateManager
{
    protected function computeText($text, array $data)
    {
        $APPLICATION_CONTEXT = new ApplicationContext();

        $quote = (isset($data['quote']) and $data['quote'] instanceof Quote) ? $data['quote'] : null;

        $app = App::getInstance();
        $_quoteFromRepository = new QuoteRepository($app->getDb());
        $usefulObject = new SiteRepository($app->getDb());
        $destinationOfQuote = new DestinationRepository($app->getDb());

        if ($quote)
        {
            $_quoteFromRepository = $_quoteFromRepository->getById($quote->id);
            $usefulObject = $usefulObject->getById($quote->siteId);
            $destinationOfQuote = $destinationOfQuote->getById($quote->destinationId);

            if(strpos($text, '[quote:destination_link]') !== false){
                $destination = $destinationOfQuote->getById($quote->destinationId);
            }

            $containsSummaryHtml = strpos($text, '[quote:summary_html]');
            $containsSummary     = strpos($text, '[quote:summary]');

            if ($containsSummaryHtml !== false || $containsSummary !== false) {
                if ($containsSummaryHtml !== false) {
                    $text = str_replace(
                        '[quote:summary_html]',
                        Quote::renderHtml($_quoteFromRepository),
                        $text
                    );
                }
                if ($containsSummary !== false) {
                    $text = str_replace(
                        '[quote:summary]',
                        Quote::renderText($_quoteFromRepository),
                        $text
                    );
                }
            }

            (strpos($text, '[quote:destination_name]') !== false) and $text = str_replace('[quote:destination_name]',$destinationOfQuote->countryName,$text);
        }

        if (isset($destination))
            $text = str_replace('[quote:destination_link]', $usefulObject->url . '/' . $destination->countryName . '/quote/' . $_quoteFromRepository->id, $text);
        else
            $text = str_replace('[quote:destination_link]', '', $text);

        /*
         * USER
         * [user:*]
         */
        $_user  = (isset($data['user'])  and ($data['user']  instanceof User))  ? $data['user']  : $APPLICATION_CONTEXT->getCurrentUser();
        if($_user) {
            (strpos($text, '[user:first_name]') !== false) and $text = str_replace('[user:first_name]'       , ucfirst(mb_strtolower($_user->firstname)), $text);
        }

        return $text;
    }
}
