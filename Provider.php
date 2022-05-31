<?php

namespace SocialiteProviders\LinkedIn;

use Laravel\Socialite\Two\LinkedInProvider;
use SocialiteProviders\Manager\ConfigTrait;
use SocialiteProviders\Manager\Contracts\OAuth2\ProviderInterface;

class Provider extends LinkedInProvider implements ProviderInterface
{
    use ConfigTrait;

    /**
     * Unique Provider Identifier.
     */
    public const IDENTIFIER = 'LINKEDIN';
    
    /**
     * Redirect the user of the application to the provider's authentication screen.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        $state = Str::random(40);

        if (!$this->isStateless()) {
            $this->request->session()->put('state', $state);
        }

        return new RedirectResponse($this->getAuthUrl($state));
    }
}
