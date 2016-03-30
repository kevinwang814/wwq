<?php
abstract class Ext_OAuth_SignatureMethod
{
	/**
	 * Return the name of this signature
	 *
	 * @return string
	 */
	abstract public function name();

	/**
	 * Return the signature for the given request
	 *
	 * @param OAuthRequest request
	 * @param string base_string
	 * @param string consumer_secret
	 * @param string token_secret
	 * @return string
	 */
	abstract public function signature ($base_string, $consumer_secret, $token_secret);
}
?>