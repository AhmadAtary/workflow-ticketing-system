<?php declare(strict_types = 1);

// osfsl-F:/New folder/FrontEnd/Asset-Manager-1/backend/vendor/composer/../php-open-source-saver/jwt-auth/src/Providers/JWT/Provider.php-PHPStan\BetterReflection\Reflection\ReflectionClass-PHPOpenSourceSaver\JWTAuth\Providers\JWT\Provider
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-fb6d4c8224de50819881dd3d0bd01c4aeae6ba0bb0058090c6c77300a79d2ae0-8.2.12-6.65.0.9',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'filename' => 'F:/New folder/FrontEnd/Asset-Manager-1/backend/vendor/composer/../php-open-source-saver/jwt-auth/src/Providers/JWT/Provider.php',
      ),
    ),
    'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
    'name' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
    'shortName' => 'Provider',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 64,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 19,
    'endLine' => 188,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'secret' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'name' => 'secret',
        'modifiers' => 2,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
          'data' => 
          array (
            'types' => 
            array (
              0 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'string',
                  'isIdentifier' => true,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'default' => NULL,
        'docComment' => '/**
 * The secret.
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 24,
        'endLine' => 24,
        'startColumn' => 5,
        'endColumn' => 30,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'keys' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'name' => 'keys',
        'modifiers' => 2,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'default' => NULL,
        'docComment' => '/**
 * The array of keys.
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 29,
        'endLine' => 29,
        'startColumn' => 5,
        'endColumn' => 26,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'algo' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'name' => 'algo',
        'modifiers' => 2,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'default' => NULL,
        'docComment' => '/**
 * The used algorithm.
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 34,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 27,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'secret' => 
          array (
            'name' => 'secret',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 44,
            'endLine' => 44,
            'startColumn' => 33,
            'endColumn' => 39,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'algo' => 
          array (
            'name' => 'algo',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 44,
            'endLine' => 44,
            'startColumn' => 42,
            'endColumn' => 46,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'keys' => 
          array (
            'name' => 'keys',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 44,
            'endLine' => 44,
            'startColumn' => 49,
            'endColumn' => 59,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Constructor.
 *
 * @param string $secret
 * @param string $algo
 *
 * @return void
 */',
        'startLine' => 44,
        'endLine' => 53,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'aliasName' => NULL,
      ),
      'setAlgo' => 
      array (
        'name' => 'setAlgo',
        'parameters' => 
        array (
          'algo' => 
          array (
            'name' => 'algo',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 62,
            'endLine' => 62,
            'startColumn' => 29,
            'endColumn' => 33,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set the algorithm used to sign the token.
 *
 * @param string $algo
 *
 * @return $this
 */',
        'startLine' => 62,
        'endLine' => 67,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'aliasName' => NULL,
      ),
      'getAlgo' => 
      array (
        'name' => 'getAlgo',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the algorithm used to sign the token.
 *
 * @return string
 */',
        'startLine' => 74,
        'endLine' => 77,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'aliasName' => NULL,
      ),
      'setSecret' => 
      array (
        'name' => 'setSecret',
        'parameters' => 
        array (
          'secret' => 
          array (
            'name' => 'secret',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 86,
            'endLine' => 86,
            'startColumn' => 31,
            'endColumn' => 37,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set the secret used to sign the token.
 *
 * @param string $secret
 *
 * @return $this
 */',
        'startLine' => 86,
        'endLine' => 91,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'aliasName' => NULL,
      ),
      'getSecret' => 
      array (
        'name' => 'getSecret',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the secret used to sign the token.
 *
 * @return string
 */',
        'startLine' => 98,
        'endLine' => 101,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'aliasName' => NULL,
      ),
      'setKeys' => 
      array (
        'name' => 'setKeys',
        'parameters' => 
        array (
          'keys' => 
          array (
            'name' => 'keys',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 108,
            'endLine' => 108,
            'startColumn' => 29,
            'endColumn' => 39,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set the keys used to sign the token.
 *
 * @return $this
 */',
        'startLine' => 108,
        'endLine' => 113,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'aliasName' => NULL,
      ),
      'getKeys' => 
      array (
        'name' => 'getKeys',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the array of keys used to sign tokens
 * with an asymmetric algorithm.
 *
 * @return array
 */',
        'startLine' => 121,
        'endLine' => 124,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'aliasName' => NULL,
      ),
      'getPublicKey' => 
      array (
        'name' => 'getPublicKey',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the public key used to sign tokens
 * with an asymmetric algorithm.
 *
 * @return resource|string
 */',
        'startLine' => 132,
        'endLine' => 135,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'aliasName' => NULL,
      ),
      'getPrivateKey' => 
      array (
        'name' => 'getPrivateKey',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the private key used to sign tokens
 * with an asymmetric algorithm.
 *
 * @return resource|string
 */',
        'startLine' => 143,
        'endLine' => 146,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'aliasName' => NULL,
      ),
      'getPassphrase' => 
      array (
        'name' => 'getPassphrase',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the passphrase used to sign tokens
 * with an asymmetric algorithm.
 *
 * @return string
 */',
        'startLine' => 154,
        'endLine' => 157,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'aliasName' => NULL,
      ),
      'getSigningKey' => 
      array (
        'name' => 'getSigningKey',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the key used to sign the tokens.
 *
 * @return resource|string
 */',
        'startLine' => 164,
        'endLine' => 167,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'aliasName' => NULL,
      ),
      'getVerificationKey' => 
      array (
        'name' => 'getVerificationKey',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the key used to verify the tokens.
 *
 * @return resource|string
 */',
        'startLine' => 174,
        'endLine' => 177,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'aliasName' => NULL,
      ),
      'isAsymmetric' => 
      array (
        'name' => 'isAsymmetric',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Determine if the algorithm is asymmetric, and thus
 * requires a public/private key combo.
 *
 * @return bool
 *
 * @throws JWTException
 */',
        'startLine' => 187,
        'endLine' => 187,
        'startColumn' => 5,
        'endColumn' => 47,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 66,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));