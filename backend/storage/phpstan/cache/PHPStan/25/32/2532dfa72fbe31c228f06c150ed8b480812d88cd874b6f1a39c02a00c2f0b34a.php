<?php declare(strict_types = 1);

// osfsl-F:/New folder/FrontEnd/Asset-Manager-1/backend/vendor/composer/../php-open-source-saver/jwt-auth/src/JWTGuard.php-PHPStan\BetterReflection\Reflection\ReflectionClass-PHPOpenSourceSaver\JWTAuth\JWTGuard
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-64560fd8bf28ab77123fac6fb40f7c107e5480fe26a37ed04e4154a2ba84f106-8.2.12-6.65.0.9',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'filename' => 'F:/New folder/FrontEnd/Asset-Manager-1/backend/vendor/composer/../php-open-source-saver/jwt-auth/src/JWTGuard.php',
      ),
    ),
    'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
    'name' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
    'shortName' => 'JWTGuard',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * @mixin JWT
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 34,
    'endLine' => 619,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'Illuminate\\Contracts\\Auth\\Guard',
    ),
    'traitClassNames' => 
    array (
      0 => 'Illuminate\\Auth\\GuardHelpers',
      1 => 'Illuminate\\Support\\Traits\\Macroable',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'lastAttempted' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'name' => 'lastAttempted',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The user we last attempted to retrieve.
 *
 * @var Authenticatable
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 48,
        'endLine' => 48,
        'startColumn' => 5,
        'endColumn' => 29,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'jwt' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'name' => 'jwt',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The JWT instance.
 *
 * @var JWT
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 55,
        'endLine' => 55,
        'startColumn' => 5,
        'endColumn' => 19,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'request' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'name' => 'request',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The request instance.
 *
 * @var Request
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 62,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 23,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'events' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'name' => 'events',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The event dispatcher instance.
 *
 * @var Dispatcher
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 69,
        'endLine' => 69,
        'startColumn' => 5,
        'endColumn' => 22,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'name' => 
      array (
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'name' => 'name',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'tymon.jwt\'',
          'attributes' => 
          array (
            'startLine' => 76,
            'endLine' => 76,
            'startTokenPos' => 162,
            'startFilePos' => 1635,
            'endTokenPos' => 162,
            'endFilePos' => 1645,
          ),
        ),
        'docComment' => '/**
 * The name of the Guard.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 76,
        'endLine' => 76,
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
          'jwt' => 
          array (
            'name' => 'jwt',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PHPOpenSourceSaver\\JWTAuth\\JWT',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 83,
            'endLine' => 83,
            'startColumn' => 33,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'provider' => 
          array (
            'name' => 'provider',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Contracts\\Auth\\UserProvider',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 83,
            'endLine' => 83,
            'startColumn' => 43,
            'endColumn' => 64,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
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
            'startLine' => 83,
            'endLine' => 83,
            'startColumn' => 67,
            'endColumn' => 82,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
          'eventDispatcher' => 
          array (
            'name' => 'eventDispatcher',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Contracts\\Events\\Dispatcher',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 83,
            'endLine' => 83,
            'startColumn' => 85,
            'endColumn' => 111,
            'parameterIndex' => 3,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Instantiate the class.
 *
 * @return void
 */',
        'startLine' => 83,
        'endLine' => 89,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'user' => 
      array (
        'name' => 'user',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the currently authenticated user.
 *
 * @return Authenticatable|null
 */',
        'startLine' => 96,
        'endLine' => 109,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'getUserId' => 
      array (
        'name' => 'getUserId',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return int|string|null
 */',
        'startLine' => 114,
        'endLine' => 129,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'id' => 
      array (
        'name' => 'id',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the ID for the currently authenticated user.
 *
 * @return int|string|null
 */',
        'startLine' => 136,
        'endLine' => 139,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'userOrFail' => 
      array (
        'name' => 'userOrFail',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the currently authenticated user or throws an exception.
 *
 * @return Authenticatable
 *
 * @throws UserNotDefinedException
 */',
        'startLine' => 148,
        'endLine' => 155,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'validate' => 
      array (
        'name' => 'validate',
        'parameters' => 
        array (
          'credentials' => 
          array (
            'name' => 'credentials',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 162,
                'endLine' => 162,
                'startTokenPos' => 529,
                'startFilePos' => 3571,
                'endTokenPos' => 530,
                'endFilePos' => 3572,
              ),
            ),
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
            'startLine' => 162,
            'endLine' => 162,
            'startColumn' => 30,
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
 * Validate a user\'s credentials.
 *
 * @return bool
 */',
        'startLine' => 162,
        'endLine' => 165,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'attempt' => 
      array (
        'name' => 'attempt',
        'parameters' => 
        array (
          'credentials' => 
          array (
            'name' => 'credentials',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 174,
                'endLine' => 174,
                'startTokenPos' => 566,
                'startFilePos' => 3869,
                'endTokenPos' => 567,
                'endFilePos' => 3870,
              ),
            ),
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
            'startLine' => 174,
            'endLine' => 174,
            'startColumn' => 29,
            'endColumn' => 51,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'login' => 
          array (
            'name' => 'login',
            'default' => 
            array (
              'code' => 'true',
              'attributes' => 
              array (
                'startLine' => 174,
                'endLine' => 174,
                'startTokenPos' => 574,
                'startFilePos' => 3882,
                'endTokenPos' => 574,
                'endFilePos' => 3885,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 174,
            'endLine' => 174,
            'startColumn' => 54,
            'endColumn' => 66,
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
 * Attempt to authenticate the user using the given credentials and return the token.
 *
 * @param bool $login
 *
 * @return bool|string
 */',
        'startLine' => 174,
        'endLine' => 187,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'login' => 
      array (
        'name' => 'login',
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
            'startLine' => 194,
            'endLine' => 194,
            'startColumn' => 27,
            'endColumn' => 42,
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
 * Create a token for a user.
 *
 * @return string
 */',
        'startLine' => 194,
        'endLine' => 202,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'logout' => 
      array (
        'name' => 'logout',
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
                'startLine' => 211,
                'endLine' => 211,
                'startTokenPos' => 730,
                'startFilePos' => 4722,
                'endTokenPos' => 730,
                'endFilePos' => 4726,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 211,
            'endLine' => 211,
            'startColumn' => 28,
            'endColumn' => 48,
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
 * Logout the user, thus invalidating the token.
 *
 * @param bool $forceForever
 *
 * @return void
 */',
        'startLine' => 211,
        'endLine' => 223,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
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
                'startLine' => 233,
                'endLine' => 233,
                'startTokenPos' => 809,
                'startFilePos' => 5242,
                'endTokenPos' => 809,
                'endFilePos' => 5246,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 233,
            'endLine' => 233,
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
                'startLine' => 233,
                'endLine' => 233,
                'startTokenPos' => 816,
                'startFilePos' => 5264,
                'endTokenPos' => 816,
                'endFilePos' => 5268,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 233,
            'endLine' => 233,
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
 * Refresh the token.
 *
 * @param bool $forceForever
 * @param bool $resetClaims
 *
 * @return string
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
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
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
                'startLine' => 245,
                'endLine' => 245,
                'startTokenPos' => 852,
                'startFilePos' => 5518,
                'endTokenPos' => 852,
                'endFilePos' => 5522,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 245,
            'endLine' => 245,
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
 * Invalidate the token.
 *
 * @param bool $forceForever
 *
 * @return JWT
 */',
        'startLine' => 245,
        'endLine' => 248,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'tokenById' => 
      array (
        'name' => 'tokenById',
        'parameters' => 
        array (
          'id' => 
          array (
            'name' => 'id',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 255,
            'endLine' => 255,
            'startColumn' => 31,
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
 * Create a new token by User id.
 *
 * @return string|null
 */',
        'startLine' => 255,
        'endLine' => 260,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'once' => 
      array (
        'name' => 'once',
        'parameters' => 
        array (
          'credentials' => 
          array (
            'name' => 'credentials',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 267,
                'endLine' => 267,
                'startTokenPos' => 935,
                'startFilePos' => 6008,
                'endTokenPos' => 936,
                'endFilePos' => 6009,
              ),
            ),
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
            'startLine' => 267,
            'endLine' => 267,
            'startColumn' => 26,
            'endColumn' => 48,
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
 * Log a user into the application using their credentials.
 *
 * @return bool
 */',
        'startLine' => 267,
        'endLine' => 276,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'onceUsingId' => 
      array (
        'name' => 'onceUsingId',
        'parameters' => 
        array (
          'id' => 
          array (
            'name' => 'id',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 283,
            'endLine' => 283,
            'startColumn' => 33,
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
 * Log the given User into the application.
 *
 * @return bool
 */',
        'startLine' => 283,
        'endLine' => 292,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'byId' => 
      array (
        'name' => 'byId',
        'parameters' => 
        array (
          'id' => 
          array (
            'name' => 'id',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 299,
            'endLine' => 299,
            'startColumn' => 26,
            'endColumn' => 28,
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
 * Alias for onceUsingId.
 *
 * @return bool
 */',
        'startLine' => 299,
        'endLine' => 302,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'claims' => 
      array (
        'name' => 'claims',
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
            'startLine' => 309,
            'endLine' => 309,
            'startColumn' => 28,
            'endColumn' => 40,
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
 * Add any custom claims.
 *
 * @return $this
 */',
        'startLine' => 309,
        'endLine' => 314,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
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
        'startLine' => 321,
        'endLine' => 324,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
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
        'startLine' => 331,
        'endLine' => 334,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
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
            'startLine' => 343,
            'endLine' => 343,
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
        'startLine' => 343,
        'endLine' => 348,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
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
 * Get the token ttl.
 *
 * @return int|null
 */',
        'startLine' => 355,
        'endLine' => 358,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
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
            'startLine' => 367,
            'endLine' => 367,
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
 * Set the token ttl.
 *
 * @param int|null $ttl
 *
 * @return $this
 */',
        'startLine' => 367,
        'endLine' => 372,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'getProvider' => 
      array (
        'name' => 'getProvider',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the user provider used by the guard.
 *
 * @return UserProvider
 */',
        'startLine' => 379,
        'endLine' => 382,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'setProvider' => 
      array (
        'name' => 'setProvider',
        'parameters' => 
        array (
          'provider' => 
          array (
            'name' => 'provider',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Contracts\\Auth\\UserProvider',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 389,
            'endLine' => 389,
            'startColumn' => 33,
            'endColumn' => 54,
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
 * Set the user provider used by the guard.
 *
 * @return $this
 */',
        'startLine' => 389,
        'endLine' => 394,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'getUser' => 
      array (
        'name' => 'getUser',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return the currently cached user.
 *
 * @return Authenticatable|null
 */',
        'startLine' => 401,
        'endLine' => 404,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'setUser' => 
      array (
        'name' => 'setUser',
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
                'name' => 'Illuminate\\Contracts\\Auth\\Authenticatable',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 411,
            'endLine' => 411,
            'startColumn' => 29,
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
 * Set the current user.
 *
 * @return $this
 */',
        'startLine' => 411,
        'endLine' => 418,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'getRequest' => 
      array (
        'name' => 'getRequest',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the current request instance.
 *
 * @return Request
 */',
        'startLine' => 425,
        'endLine' => 428,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
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
            'startLine' => 435,
            'endLine' => 435,
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
 * Set the current request instance.
 *
 * @return $this
 */',
        'startLine' => 435,
        'endLine' => 440,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'getLastAttempted' => 
      array (
        'name' => 'getLastAttempted',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the last user we attempted to authenticate.
 *
 * @return Authenticatable
 */',
        'startLine' => 447,
        'endLine' => 450,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'hasValidCredentials' => 
      array (
        'name' => 'hasValidCredentials',
        'parameters' => 
        array (
          'user' => 
          array (
            'name' => 'user',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 459,
            'endLine' => 459,
            'startColumn' => 44,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'credentials' => 
          array (
            'name' => 'credentials',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 459,
            'endLine' => 459,
            'startColumn' => 51,
            'endColumn' => 62,
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
 * Determine if the user matches the credentials.
 *
 * @param array $credentials
 *
 * @return bool
 */',
        'startLine' => 459,
        'endLine' => 468,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'validateSubject' => 
      array (
        'name' => 'validateSubject',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Ensure the JWTSubject matches what is in the token.
 *
 * @return bool
 */',
        'startLine' => 475,
        'endLine' => 484,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
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
 * Ensure that a token is available in the request.
 *
 * @return JWT
 *
 * @throws JWTException
 */',
        'startLine' => 493,
        'endLine' => 500,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'fireAttemptEvent' => 
      array (
        'name' => 'fireAttemptEvent',
        'parameters' => 
        array (
          'credentials' => 
          array (
            'name' => 'credentials',
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
            'startLine' => 507,
            'endLine' => 507,
            'startColumn' => 41,
            'endColumn' => 58,
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
 * Fire the attempt event.
 *
 * @return void
 */',
        'startLine' => 507,
        'endLine' => 514,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'fireValidatedEvent' => 
      array (
        'name' => 'fireValidatedEvent',
        'parameters' => 
        array (
          'user' => 
          array (
            'name' => 'user',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 523,
            'endLine' => 523,
            'startColumn' => 43,
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
 * Fires the validated event.
 *
 * @param Authenticatable $user
 *
 * @return void
 */',
        'startLine' => 523,
        'endLine' => 533,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'fireFailedEvent' => 
      array (
        'name' => 'fireFailedEvent',
        'parameters' => 
        array (
          'user' => 
          array (
            'name' => 'user',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 542,
            'endLine' => 542,
            'startColumn' => 40,
            'endColumn' => 44,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'credentials' => 
          array (
            'name' => 'credentials',
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
            'startLine' => 542,
            'endLine' => 542,
            'startColumn' => 47,
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
 * Fire the failed authentication attempt event.
 *
 * @param Authenticatable|null $user
 *
 * @return void
 */',
        'startLine' => 542,
        'endLine' => 549,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'fireAuthenticatedEvent' => 
      array (
        'name' => 'fireAuthenticatedEvent',
        'parameters' => 
        array (
          'user' => 
          array (
            'name' => 'user',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 558,
            'endLine' => 558,
            'startColumn' => 47,
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
 * Fire the authenticated event.
 *
 * @param Authenticatable $user
 *
 * @return void
 */',
        'startLine' => 558,
        'endLine' => 564,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'fireLoginEvent' => 
      array (
        'name' => 'fireLoginEvent',
        'parameters' => 
        array (
          'user' => 
          array (
            'name' => 'user',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 574,
            'endLine' => 574,
            'startColumn' => 39,
            'endColumn' => 43,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'remember' => 
          array (
            'name' => 'remember',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 574,
                'endLine' => 574,
                'startTokenPos' => 1803,
                'startFilePos' => 11998,
                'endTokenPos' => 1803,
                'endFilePos' => 12002,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 574,
            'endLine' => 574,
            'startColumn' => 46,
            'endColumn' => 62,
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
 * Fire the login event.
 *
 * @param Authenticatable $user
 * @param bool            $remember
 *
 * @return void
 */',
        'startLine' => 574,
        'endLine' => 581,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
      'fireLogoutEvent' => 
      array (
        'name' => 'fireLogoutEvent',
        'parameters' => 
        array (
          'user' => 
          array (
            'name' => 'user',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 591,
            'endLine' => 591,
            'startColumn' => 40,
            'endColumn' => 44,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'remember' => 
          array (
            'name' => 'remember',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 591,
                'endLine' => 591,
                'startTokenPos' => 1850,
                'startFilePos' => 12353,
                'endTokenPos' => 1850,
                'endFilePos' => 12357,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 591,
            'endLine' => 591,
            'startColumn' => 47,
            'endColumn' => 63,
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
 * Fire the logout event.
 *
 * @param Authenticatable $user
 * @param bool            $remember
 *
 * @return void
 */',
        'startLine' => 591,
        'endLine' => 597,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
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
            'startLine' => 607,
            'endLine' => 607,
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
            'startLine' => 607,
            'endLine' => 607,
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
 * Magically call the JWT instance.
 *
 * @param string $method
 * @param array  $parameters
 *
 * @throws \\BadMethodCallException
 */',
        'startLine' => 607,
        'endLine' => 618,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPOpenSourceSaver\\JWTAuth',
        'declaringClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'implementingClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'currentClassName' => 'PHPOpenSourceSaver\\JWTAuth\\JWTGuard',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
        'Illuminate\\Auth\\GuardHelpers' => 
        array (
          0 => 
          array (
            'alias' => 'guardHelperSetUser',
            'method' => 'setUser',
            'hash' => 'illuminate\\auth\\guardhelpers::setuser',
          ),
        ),
        'Illuminate\\Support\\Traits\\Macroable' => 
        array (
          0 => 
          array (
            'alias' => 'macroCall',
            'method' => '__call',
            'hash' => 'illuminate\\support\\traits\\macroable::__call',
          ),
        ),
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
        'illuminate\\auth\\guardhelpers::setuser' => 'Illuminate\\Auth\\GuardHelpers::setUser',
        'illuminate\\support\\traits\\macroable::__call' => 'Illuminate\\Support\\Traits\\Macroable::__call',
      ),
    ),
  ),
));