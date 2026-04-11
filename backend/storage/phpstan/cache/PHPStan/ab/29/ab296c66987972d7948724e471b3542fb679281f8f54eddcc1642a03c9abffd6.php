<?php declare(strict_types = 1);

// osfsl-F:/New folder/FrontEnd/Asset-Manager-1/backend/vendor/composer/../php-open-source-saver/jwt-auth/src/Providers/JWT/Lcobucci.php-PHPStan\BetterReflection\Reflection\ReflectionClass-PHPOpenSourceSaver\JWTAuth\Providers\JWT\Lcobucci
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-ec3976eea2711467832c68f613070b053694944a18077f2e876fdbbbb2baea95-8.2.12-6.65.0.9',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'filename' => 'F:/New folder/FrontEnd/Asset-Manager-1/backend/vendor/composer/../php-open-source-saver/jwt-auth/src/Providers/JWT/Lcobucci.php',
      ),
    ),
    'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
    'name' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
    'shortName' => 'Lcobucci',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 38,
    'endLine' => 274,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Provider',
    'implementsClassNames' => 
    array (
      0 => 'PHPOpenSourceSaver\\JWTAuth\\Contracts\\Providers\\JWT',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'builder' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'name' => 'builder',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The builder instance.
 *
 * @var Builder
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 45,
        'endLine' => 45,
        'startColumn' => 5,
        'endColumn' => 23,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'config' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'name' => 'config',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The configuration instance.
 *
 * @var Configuration
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 52,
        'endLine' => 52,
        'startColumn' => 5,
        'endColumn' => 22,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'signer' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'name' => 'signer',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The Signer instance.
 *
 * @var Signer
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 59,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 22,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'signers' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'name' => 'signers',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'HS256\' => \\Lcobucci\\JWT\\Signer\\Hmac\\Sha256::class, \'HS384\' => \\Lcobucci\\JWT\\Signer\\Hmac\\Sha384::class, \'HS512\' => \\Lcobucci\\JWT\\Signer\\Hmac\\Sha512::class, \'RS256\' => \\Lcobucci\\JWT\\Signer\\Rsa\\Sha256::class, \'RS384\' => \\Lcobucci\\JWT\\Signer\\Rsa\\Sha384::class, \'RS512\' => \\Lcobucci\\JWT\\Signer\\Rsa\\Sha512::class, \'ES256\' => \\Lcobucci\\JWT\\Signer\\Ecdsa\\Sha256::class, \'ES384\' => \\Lcobucci\\JWT\\Signer\\Ecdsa\\Sha384::class, \'ES512\' => \\Lcobucci\\JWT\\Signer\\Ecdsa\\Sha512::class]',
          'attributes' => 
          array (
            'startLine' => 135,
            'endLine' => 145,
            'startTokenPos' => 490,
            'startFilePos' => 3535,
            'endTokenPos' => 573,
            'endFilePos' => 3838,
          ),
        ),
        'docComment' => '/**
 * Signers that this provider supports.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 135,
        'endLine' => 145,
        'startColumn' => 5,
        'endColumn' => 6,
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
            'startLine' => 71,
            'endLine' => 71,
            'startColumn' => 9,
            'endColumn' => 15,
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
            'startLine' => 72,
            'endLine' => 72,
            'startColumn' => 9,
            'endColumn' => 13,
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
            'startLine' => 73,
            'endLine' => 73,
            'startColumn' => 9,
            'endColumn' => 19,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
          'config' => 
          array (
            'name' => 'config',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 74,
                'endLine' => 74,
                'startTokenPos' => 214,
                'startFilePos' => 1947,
                'endTokenPos' => 214,
                'endFilePos' => 1950,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 74,
            'endLine' => 74,
            'startColumn' => 9,
            'endColumn' => 22,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create the Lcobucci provider.
 *
 * @param string        $secret
 * @param string        $algo
 * @param Configuration $config optional, to pass an existing configuration to be used
 *
 * @return void
 */',
        'startLine' => 70,
        'endLine' => 78,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'aliasName' => NULL,
      ),
      'generateConfig' => 
      array (
        'name' => 'generateConfig',
        'parameters' => 
        array (
          'config' => 
          array (
            'name' => 'config',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 87,
                'endLine' => 87,
                'startTokenPos' => 257,
                'startFilePos' => 2275,
                'endTokenPos' => 257,
                'endFilePos' => 2278,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 87,
            'endLine' => 87,
            'startColumn' => 37,
            'endColumn' => 50,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Generate the config.
 *
 * @param Configuration $config optional, to pass an existing configuration to be used
 *
 * @return void
 */',
        'startLine' => 87,
        'endLine' => 103,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
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
            'startLine' => 112,
            'endLine' => 112,
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
 * Set the secret used to sign the token and regenerate the config using the secret.
 *
 * @param string $secret
 *
 * @return $this
 */',
        'startLine' => 112,
        'endLine' => 118,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'aliasName' => NULL,
      ),
      'getConfig' => 
      array (
        'name' => 'getConfig',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Gets the {@see $config} attribute.
 *
 * @return Configuration
 */',
        'startLine' => 125,
        'endLine' => 128,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'aliasName' => NULL,
      ),
      'encode' => 
      array (
        'name' => 'encode',
        'parameters' => 
        array (
          'payload' => 
          array (
            'name' => 'payload',
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
            'startLine' => 154,
            'endLine' => 154,
            'startColumn' => 28,
            'endColumn' => 41,
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
 * Create a JSON Web Token.
 *
 * @return string
 *
 * @throws JWTException
 */',
        'startLine' => 154,
        'endLine' => 168,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'aliasName' => NULL,
      ),
      'decode' => 
      array (
        'name' => 'decode',
        'parameters' => 
        array (
          'token' => 
          array (
            'name' => 'token',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 179,
            'endLine' => 179,
            'startColumn' => 28,
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
 * Decode a JSON Web Token.
 *
 * @param string $token
 *
 * @return array
 *
 * @throws JWTException
 */',
        'startLine' => 179,
        'endLine' => 201,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'aliasName' => NULL,
      ),
      'addClaim' => 
      array (
        'name' => 'addClaim',
        'parameters' => 
        array (
          'key' => 
          array (
            'name' => 'key',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 208,
            'endLine' => 208,
            'startColumn' => 33,
            'endColumn' => 36,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'value' => 
          array (
            'name' => 'value',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 208,
            'endLine' => 208,
            'startColumn' => 39,
            'endColumn' => 44,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Lcobucci\\JWT\\Builder',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Adds a claim to the {@see $config}.
 *
 * @param string $key
 */',
        'startLine' => 208,
        'endLine' => 224,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'aliasName' => NULL,
      ),
      'getSigner' => 
      array (
        'name' => 'getSigner',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the signer instance.
 *
 * @return Signer
 *
 * @throws JWTException
 */',
        'startLine' => 233,
        'endLine' => 242,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
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
        'docComment' => NULL,
        'startLine' => 244,
        'endLine' => 249,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
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
 * @return Key|string
 */',
        'startLine' => 256,
        'endLine' => 261,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
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
 * @return Key|string
 */',
        'startLine' => 268,
        'endLine' => 273,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
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