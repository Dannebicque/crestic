<?php
/**
 * Created by PhpStorm.
 * User: davidannebicque
 * Date: 25/01/2018
 * Time: 15:00
 */

namespace AppBundle\Controller;


use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class CasAuthenticator extends AbstractGuardAuthenticator
{
    private $em;
    private $tokenStorage;

    public function __construct(EntityManager $em, TokenStorageInterface $tokenStorage)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/logout", name="cas_security_logout")
     */
    public function logout()
    {
        \phpCAS::logout();
    }

    /**
     * Called on every request. Return whatever credentials you want,
     * or null to stop authentication.
     */
    public function getCredentials(Request $request)
    {
        //\phpCAS::setDebug();
        //\phpCAS::setVerbose(true);
        //\phpCAS::setLang(PHPCAS_LANG_FRENCH);
        \phpCAS::client(CAS_VERSION_2_0, "cas.univ-reims.fr", 443, "/cas/");
       // \phpCAS::setCasServerCACert($mon_certificat);
        \phpCAS::setNoCasServerValidation();
        //\phpCAS::handleLogoutRequests();
        \phpCAS::forceAuthentication();

        if (\phpCAS::getUser()) {
            return \phpCAS::getUser();
        }

        return null;
    }


    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $this->em->getRepository('AppBundle:MembresCrestic')->findOneBy(array('username' => $credentials ));
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = array(
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        );
        return new JsonResponse(    $data, 403);
    }


    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse('cas.univ-reims.fr/cas?service=' . $request->getUri());
    }


    public function supportsRememberMe()
    {
        return false;
    }
}