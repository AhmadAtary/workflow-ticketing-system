<?php declare(strict_types = 1);

// osfsl-F:/New folder/FrontEnd/Asset-Manager-1/backend/vendor/composer/../php-open-source-saver/jwt-auth/src/Factory.php-PHPStan\BetterReflection\Reflection\ReflectionClass-PHPOpenSourceSaver\JWTAuth\Factory
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-133ddce3adcee9d2b0cac7ee983727115e1392990c569ce07dfe9e9d69506a61-8.2.12-6.65.0.9',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'filename' => 'F:/New folder/FrontEnd/Asset-Manager-1/backend/vendor/composer/../php-open-source-saver/jwt-auth/src/Factory.php',
      ),
    ),
    'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
    'name' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
    'shortName' => 'Factory',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 22,
    'endLine' => 252,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'PHPOpenSourceSaver\\JWTAuth\\Support\\CustomClaims',
      1 => 'PHPOpenSourceSaver\\JWTAuth\\Support\\RefreshFlow',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'claimFactory' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'name' => 'claimFactory',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The claim factory.
 *
 * @var ClaimFactory
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 32,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 28,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'validator' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'name' => 'validator',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The validator.
 *
 * @var PayloadValidator
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 39,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 25,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'defaultClaims' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'name' => 'defaultClaims',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'iss\', \'iat\', \'exp\', \'nbf\', \'jti\']',
          'attributes' => 
          array (
            'startLine' => 46,
            'endLine' => 52,
            'startTokenPos' => 81,
            'startFilePos' => 992,
            'endTokenPos' => 98,
            'endFilePos' => 1073,
          ),
        ),
        'docComment' => '/**
 * The default claims.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 46,
        'endLine' => 52,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'claims' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'name' => 'claims',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The claims collection.
 *
 * @var Collection
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
    ),
    'immediateMethods' => 
    array (
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'claimFactory' => 
          array (
            'name' => 'claimFactory',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PHPOpenSourceSaver\\JWTAuth\\Claims\\Factory',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 66,
            'endLine' => 66,
            'startColumn' => 33,
            'endColumn' => 58,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'validator' => 
          array (
            'name' => 'validator',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PHPOpenSourceSaver\\JWTAuth\\Validators\\PayloadValidator',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 66,
            'endLine' => 66,
            'startColumn' => 61,
            'endColumn' => 87,
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
 * Constructor.
 *
 * @return void
 */',
        'startLine' => 66,
        'endLine' => 71,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'aliasName' => NULL,
      ),
      'make' => 
      array (
        'name' => 'make',
        'parameters' => 
        array (
          'resetClaims' => 
          array (
            'name' => 'resetClaims',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 80,
                'endLine' => 80,
                'startTokenPos' => 173,
                'startFilePos' => 1629,
                'endTokenPos' => 173,
                'endFilePos' => 1633,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 80,
            'endLine' => 80,
            'startColumn' => 26,
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
 * Create the Payload instance.
 *
 * @param bool $resetClaims
 *
 * @return Payload
 */',
        'startLine' => 80,
        'endLine' => 87,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'aliasName' => NULL,
      ),
      'emptyClaims' => 
      array (
        'name' => 'emptyClaims',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Empty the claims collection.
 *
 * @return $this
 */',
        'startLine' => 94,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'aliasName' => NULL,
      ),
      'addClaims' => 
      array (
        'name' => 'addClaims',
        'parameters' => 
        array (
          'claims' => 
          array (
            'name' => 'claims',
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
            'startLine' => 106,
            'endLine' => 106,
            'startColumn' => 34,
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
 * Add an array of claims to the Payload.
 *
 * @return $this
 */',
        'startLine' => 106,
        'endLine' => 113,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'aliasName' => NULL,
      ),
      'addClaim' => 
      array (
        'name' => 'addClaim',
        'parameters' => 
        array (
          'name' => 
          array (
            'name' => 'name',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 122,
            'endLine' => 122,
            'startColumn' => 33,
            'endColumn' => 37,
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
            'startLine' => 122,
            'endLine' => 122,
            'startColumn' => 40,
            'endColumn' => 45,
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
 * Add a claim to the Payload.
 *
 * @param string $name
 *
 * @return $this
 */',
        'startLine' => 122,
        'endLine' => 127,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'aliasName' => NULL,
      ),
      'buildClaims' => 
      array (
        'name' => 'buildClaims',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Build the default claims.
 *
 * @return $this
 */',
        'startLine' => 134,
        'endLine' => 148,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'aliasName' => NULL,
      ),
      'resolveClaims' => 
      array (
        'name' => 'resolveClaims',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Build out the Claim DTO\'s.
 *
 * @return Collection
 */',
        'startLine' => 155,
        'endLine' => 160,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'aliasName' => NULL,
      ),
      'buildClaimsCollection' => 
      array (
        'name' => 'buildClaimsCollection',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Build and get the Claims Collection.
 *
 * @return Collection
 */',
        'startLine' => 167,
        'endLine' => 170,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'aliasName' => NULL,
      ),
      'withClaims' => 
      array (
        'name' => 'withClaims',
        'parameters' => 
        array (
          'claims' => 
          array (
            'name' => 'claims',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PHPOpenSourceSaver\\JWTAuth\\Claims\\Collection',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 177,
            'endLine' => 177,
            'startColumn' => 32,
            'endColumn' => 49,
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
 * Get a Payload instance with a claims collection.
 *
 * @return Payload
 */',
        'startLine' => 177,
        'endLine' => 180,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'aliasName' => NULL,
      ),
      'setDefaultClaims' => 
      array (
        'name' => 'setDefaultClaims',
        'parameters' => 
        array (
          'claims' => 
          array (
            'name' => 'claims',
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
            'startLine' => 187,
            'endLine' => 187,
            'startColumn' => 38,
            'endColumn' => 50,
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
 * Set the default claims to be added to the Payload.
 *
 * @return $this
 */',
        'startLine' => 187,
        'endLine' => 192,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'aliasName' => NULL,
      ),
      'setTTL' => 
      array (
        'name' => 'setTTL',
        'parameters' => 
        array (
          'ttl' => 
          array (
            'name' => 'ttl',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 201,
            'endLine' => 201,
            'startColumn' => 28,
            'endColumn' => 31,
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
 * Helper to set the ttl.
 *
 * @param int|null $ttl
 *
 * @return $this
 */',
        'startLine' => 201,
        'endLine' => 206,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'aliasName' => NULL,
      ),
      'getTTL' => 
      array (
        'name' => 'getTTL',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Helper to get the ttl.
 *
 * @return int|null
 */',
        'startLine' => 213,
        'endLine' => 216,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'aliasName' => NULL,
      ),
      'getDefaultClaims' => 
      array (
        'name' => 'getDefaultClaims',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the default claims.
 *
 * @return array
 */',
        'startLine' => 223,
        'endLine' => 226,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'aliasName' => NULL,
      ),
      'validator' => 
      array (
        'name' => 'validator',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the PayloadValidator instance.
 *
 * @return PayloadValidator
 */',
        'startLine' => 233,
        'endLine' => 236,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
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
            'startLine' => 246,
            'endLine' => 246,
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
            'startLine' => 246,
            'endLine' => 246,
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
 * Magically add a claim.
 *
 * @param string $method
 * @param array  $parameters
 *
 * @return $this
 */',
        'startLine' => 246,
        'endLine' => 251,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\Factory',
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