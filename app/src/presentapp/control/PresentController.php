<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 06/11/17
 * Time: 15:56
 */

namespace presentapp\control;


use presentapp\auth\PresentAuthentification;

class PresentController extends \mf\control\AbstractController
{
    /* Méthode viewHome :
     *
     * Réalise la fonctionnalité : afficher la liste des cadeaux
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function viewPresent(){
        /*$listTweet = tweet::get();

        $vue = new \tweeterapp\view\TweeterView($listTweet);
        return $vue->render('home');*/
        $vue = new \presentapp\view\PresentView('');
        return $vue->render('renderViewPresent');

    }


    // VUE INSCRIPTION
    public function viewSignUp(){

        $vue = new \presentapp\view\PresentView('');
        return $vue->render('renderViewSignUp');
    }


    // CONTROL DE L'INSCRIPTION
    public function checkSignup(){

        if(filter_has_var(INPUT_POST,'fullname') AND filter_has_var(INPUT_POST,'username') AND filter_has_var(INPUT_POST,'pw') AND filter_has_var(INPUT_POST,'pw') AND filter_has_var(INPUT_POST,'pw_repeat') AND filter_has_var(INPUT_POST, 'mail')){

            $email_a = $_POST["mail"];

            if(filter_var($email_a, FILTER_VALIDATE_EMAIL)){

                $fullname = filter_input(INPUT_POST,'fullname',FILTER_SANITIZE_SPECIAL_CHARS);
                $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS);
                $pw = filter_input(INPUT_POST,'pw',FILTER_SANITIZE_SPECIAL_CHARS);
                $pw_repeat = filter_input(INPUT_POST,'pw_repeat',FILTER_SANITIZE_SPECIAL_CHARS);

                if($pw === $pw_repeat){

                    $signUp = new PresentAuthentification();
                    $signUp->createUser($username, $pw, $fullname,$email_a);

                    $this->viewPresent();

                } else {

                    $this->viewSignUp();
                }

            } else {

                $this->checkSignup();

            }
        }
    }
}