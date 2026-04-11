<?php declare(strict_types = 1);

// osfsl-F:/New folder/FrontEnd/Asset-Manager-1/backend/vendor/composer/../php-open-source-saver/jwt-auth/src/JWT.php-PHPStan\BetterReflection\Reflection\ReflectionClass-PHPOpenSourceSaver\JWTAuth\JWT
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-d73b7be0cffab4ed1298b7ddec433801b52ba0f5180cbbbc286d50a5cb6650e9-8.2.12-6.65.0.9',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'filename' => 'F:/New folder/FrontEnd/Asset-Manager-1/backend/vendor/composer/../php-open-source-saver/jwt-auth/src/JWT.php',
      ),
    ),
    'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
    'name' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
    'shortName' => 'JWT',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 21,
    'endLine' => 402,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'PHPOpenSourceSaver\\JWTAuth\\Support\\CustomClaims',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'manager' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'name' => 'manager',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The authentication manager.
 *
 * @var Manager
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 30,
        'endLine' => 30,
        'startColumn' => 5,
        'endColumn' => 23,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'parser' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'name' => 'parser',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The HTTP parser.
 *
 * @var Parser
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 37,
        'endLine' => 37,
        'startColumn' => 5,
        'endColumn' => 22,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'token' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'name' => 'token',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The token.
 *
 * @var Token|null
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 44,
        'endLine' => 44,
        'startColumn' => 5,
        'endColumn' => 21,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'lockSubject' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'name' => 'lockSubject',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'true',
          'attributes' => 
          array (
            'startLine' => 51,
            'endLine' => 51,
            'startTokenPos' => 74,
            'startFilePos' => 956,
            'endTokenPos' => 74,
            'endFilePos' => 959,
          ),
        ),
        'docComment' => '/**
 * Lock the subject.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 51,
        'endLine' => 51,
        'startColumn' => 5,
        'endColumn' => 34,
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
          'manager' => 
          array (
            'name' => 'manager',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PHPOpenSourceSaver\\JWTAuth\\Manager',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 58,
            'endLine' => 58,
            'startColumn' => 33,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'parser' => 
          array (
            'name' => 'parser',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PHPOpenSourceSaver\\JWTAuth\\Http\\Parser\\Parser',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 58,
            'endLine' => 58,
            'startColumn' => 51,
            'endColumn' => 64,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * JWT constructor.
 *
 * @return void
 */',
        'startLine' => 58,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'fromSubject' => 
      array (
        'name' => 'fromSubject',
        'parameters' => 
        array (
          'subject' => 
          array (
            'name' => 'subject',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PHPOpenSourceSaver\\JWTAuth\\Contracts\\JWTSubject',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 69,
            'endLine' => 69,
            'startColumn' => 33,
            'endColumn' => 51,
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
 * Generate a token for a given subject.
 *
 * @return string
 */',
        'startLine' => 69,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'fromUser' => 
      array (
        'name' => 'fromUser',
        'parameters' => 
        array (
          'user' => 
          array (
            'name' => 'user',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PHPOpenSourceSaver\\JWTAuth\\Contracts\\JWTSubject',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 81,
            'endLine' => 81,
            'startColumn' => 30,
            'endColumn' => 45,
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
 * Alias to generate a token for a given user.
 *
 * @return string
 */',
        'startLine' => 81,
        'endLine' => 84,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'refresh' => 
      array (
        'name' => 'refresh',
        'parameters' => 
        array (
          'forceForever' => 
          array (
            'name' => 'forceForever',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 94,
                'endLine' => 94,
                'startTokenPos' => 201,
                'startFilePos' => 1831,
                'endTokenPos' => 201,
                'endFilePos' => 1835,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 94,
            'endLine' => 94,
            'startColumn' => 29,
            'endColumn' => 49,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'resetClaims' => 
          array (
            'name' => 'resetClaims',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 94,
                'endLine' => 94,
                'startTokenPos' => 208,
                'startFilePos' => 1853,
                'endTokenPos' => 208,
                'endFilePos' => 1857,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 94,
            'endLine' => 94,
            'startColumn' => 52,
            'endColumn' => 71,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Refresh an expired token.
 *
 * @param bool $forceForever
 * @param bool $resetClaims
 *
 * @return string
 */',
        'startLine' => 94,
        'endLine' => 101,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'invalidate' => 
      array (
        'name' => 'invalidate',
        'parameters' => 
        array (
          'forceForever' => 
          array (
            'name' => 'forceForever',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 110,
                'endLine' => 110,
                'startTokenPos' => 269,
                'startFilePos' => 2245,
                'endTokenPos' => 269,
                'endFilePos' => 2249,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 110,
            'endLine' => 110,
            'startColumn' => 32,
            'endColumn' => 52,
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
 * Invalidate a token (add it to the blacklist).
 *
 * @param bool $forceForever
 *
 * @return $this
 */',
        'startLine' => 110,
        'endLine' => 117,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'checkOrFail' => 
      array (
        'name' => 'checkOrFail',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Alias to get the payload, and as a result checks that
 * the token is valid i.e. not expired or blacklisted.
 *
 * @return Payload
 *
 * @throws JWTException
 */',
        'startLine' => 127,
        'endLine' => 130,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'check' => 
      array (
        'name' => 'check',
        'parameters' => 
        array (
          'getPayload' => 
          array (
            'name' => 'getPayload',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 139,
                'endLine' => 139,
                'startTokenPos' => 338,
                'startFilePos' => 2836,
                'endTokenPos' => 338,
                'endFilePos' => 2840,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 139,
            'endLine' => 139,
            'startColumn' => 27,
            'endColumn' => 45,
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
 * Check that the token is valid.
 *
 * @param bool $getPayload
 *
 * @return Payload|bool
 */',
        'startLine' => 139,
        'endLine' => 148,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'getToken' => 
      array (
        'name' => 'getToken',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the token.
 *
 * @return Token|null
 */',
        'startLine' => 155,
        'endLine' => 166,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'parseToken' => 
      array (
        'name' => 'parseToken',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Parse the token from the request.
 *
 * @return $this
 *
 * @throws JWTException
 */',
        'startLine' => 175,
        'endLine' => 182,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'getPayload' => 
      array (
        'name' => 'getPayload',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the raw Payload instance.
 *
 * @return Payload
 */',
        'startLine' => 189,
        'endLine' => 194,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'payload' => 
      array (
        'name' => 'payload',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Alias for getPayload().
 *
 * @return Payload
 */',
        'startLine' => 201,
        'endLine' => 204,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'getClaim' => 
      array (
        'name' => 'getClaim',
        'parameters' => 
        array (
          'claim' => 
          array (
            'name' => 'claim',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 211,
            'endLine' => 211,
            'startColumn' => 30,
            'endColumn' => 35,
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
 * Convenience method to get a claim value.
 *
 * @param string $claim
 */',
        'startLine' => 211,
        'endLine' => 214,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'makePayload' => 
      array (
        'name' => 'makePayload',
        'parameters' => 
        array (
          'subject' => 
          array (
            'name' => 'subject',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PHPOpenSourceSaver\\JWTAuth\\Contracts\\JWTSubject',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 221,
            'endLine' => 221,
            'startColumn' => 33,
            'endColumn' => 51,
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
 * Create a Payload instance.
 *
 * @return Payload
 */',
        'startLine' => 221,
        'endLine' => 224,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'getClaimsArray' => 
      array (
        'name' => 'getClaimsArray',
        'parameters' => 
        array (
          'subject' => 
          array (
            'name' => 'subject',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PHPOpenSourceSaver\\JWTAuth\\Contracts\\JWTSubject',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 231,
            'endLine' => 231,
            'startColumn' => 39,
            'endColumn' => 57,
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
 * Build the claims array and return it.
 *
 * @return array
 */',
        'startLine' => 231,
        'endLine' => 238,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'getClaimsForSubject' => 
      array (
        'name' => 'getClaimsForSubject',
        'parameters' => 
        array (
          'subject' => 
          array (
            'name' => 'subject',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PHPOpenSourceSaver\\JWTAuth\\Contracts\\JWTSubject',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 245,
            'endLine' => 245,
            'startColumn' => 44,
            'endColumn' => 62,
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
 * Get the claims associated with a given subject.
 *
 * @return array
 */',
        'startLine' => 245,
        'endLine' => 250,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'hashSubjectModel' => 
      array (
        'name' => 'hashSubjectModel',
        'parameters' => 
        array (
          'model' => 
          array (
            'name' => 'model',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 259,
            'endLine' => 259,
            'startColumn' => 41,
            'endColumn' => 46,
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
 * Hash the subject model and return it.
 *
 * @param string|object $model
 *
 * @return string
 */',
        'startLine' => 259,
        'endLine' => 262,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'checkSubjectModel' => 
      array (
        'name' => 'checkSubjectModel',
        'parameters' => 
        array (
          'model' => 
          array (
            'name' => 'model',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 271,
            'endLine' => 271,
            'startColumn' => 39,
            'endColumn' => 44,
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
 * Check if the subject model matches the one saved in the token.
 *
 * @param string|object $model
 *
 * @return bool
 */',
        'startLine' => 271,
        'endLine' => 278,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'setToken' => 
      array (
        'name' => 'setToken',
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
            'startLine' => 287,
            'endLine' => 287,
            'startColumn' => 30,
            'endColumn' => 35,
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
 * Set the token.
 *
 * @param Token|string $token
 *
 * @return $this
 */',
        'startLine' => 287,
        'endLine' => 292,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'unsetToken' => 
      array (
        'name' => 'unsetToken',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Unset the current token.
 *
 * @return $this
 */',
        'startLine' => 299,
        'endLine' => 304,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'requireToken' => 
      array (
        'name' => 'requireToken',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Ensure that a token is available.
 *
 * @return void
 *
 * @throws JWTException
 */',
        'startLine' => 313,
        'endLine' => 318,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'setRequest' => 
      array (
        'name' => 'setRequest',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Http\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 325,
            'endLine' => 325,
            'startColumn' => 32,
            'endColumn' => 47,
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
 * Set the request instance.
 *
 * @return $this
 */',
        'startLine' => 325,
        'endLine' => 330,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'lockSubject' => 
      array (
        'name' => 'lockSubject',
        'parameters' => 
        array (
          'lock' => 
          array (
            'name' => 'lock',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 339,
            'endLine' => 339,
            'startColumn' => 33,
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
 * Set whether the subject should be "locked".
 *
 * @param bool $lock
 *
 * @return $this
 */',
        'startLine' => 339,
        'endLine' => 344,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'manager' => 
      array (
        'name' => 'manager',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the Manager instance.
 *
 * @return Manager
 */',
        'startLine' => 351,
        'endLine' => 354,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'parser' => 
      array (
        'name' => 'parser',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the Parser instance.
 *
 * @return Parser
 */',
        'startLine' => 361,
        'endLine' => 364,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'factory' => 
      array (
        'name' => 'factory',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the Payload Factory.
 *
 * @return Factory
 */',
        'startLine' => 371,
        'endLine' => 374,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      'blacklist' => 
      array (
        'name' => 'blacklist',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the Blacklist.
 *
 * @return Blacklist
 */',
        'startLine' => 381,
        'endLine' => 384,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'aliasName' => NULL,
      ),
      '__call' => 
      array (
        'name' => '__call',
        'parameters' => 
        array (
          'method' => 
          array (
            'name' => 'method',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 394,
            'endLine' => 394,
            'startColumn' => 28,
            'endColumn' => 34,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'parameters' => 
          array (
            'name' => 'parameters',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 394,
            'endLine' => 394,
            'startColumn' => 37,
            'endColumn' => 47,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Magically call the JWT Manager.
 *
 * @param string $method
 * @param array  $parameters
 *
 * @throws \\BadMethodCallException
 */',
        'startLine' => 394,
        'endLine' => 401,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
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