<?php

namespace Extranet\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ExtranetUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
