# GitHub Copilot Onboarding Guide

## Repository Overview

This repository contains **revolution/laravel-google-searchconsole**, a Laravel package that provides a PHP wrapper for the Google Search Console API. The package simplifies integration with Google's Search Console API, allowing Laravel applications to query search analytics data, manage site properties, and analyze website performance in Google Search.

**Primary Purpose**: Enable Laravel developers to easily integrate Google Search Console API functionality into their applications with minimal configuration and maximum flexibility.

## Key Technologies & Frameworks

- **PHP**: ^8.2 (modern PHP features, typed properties, union types)
- **Laravel**: ^11.0 || ^12.0 (Laravel framework integration)
- **Google APIs Client Library**: Via `revolution/laravel-google-sheets` dependency
- **Testing**: PHPUnit with Orchestra Testbench for Laravel package testing
- **Code Quality**: Laravel Pint for code formatting (Laravel preset)
- **Authentication**: OAuth 2.0 and Service Account support

## Project Structure

```
├── .github/                     # GitHub configuration
│   └── workflows/              # CI/CD pipelines
├── src/                        # Main source code
│   ├── Commands/               # Artisan commands
│   │   ├── QueryMakeCommand.php    # Generate query classes
│   │   └── stubs/query.stub        # Template for query classes
│   ├── Concerns/               # Traits
│   │   └── SearchConsole.php       # Model integration trait
│   ├── Contracts/              # Interfaces
│   │   ├── Factory.php             # Main service contract
│   │   └── Query.php               # Query interface
│   ├── Facades/                # Laravel facades
│   │   └── SearchConsole.php       # Primary facade
│   ├── Providers/              # Service providers
│   │   └── SearchConsoleServiceProvider.php
│   ├── Query/                  # Query builders
│   │   └── AbstractQuery.php       # Base query class
│   └── SearchConsoleClient.php     # Main client implementation
├── tests/                      # Test suite
│   ├── Search/                 # Example query classes
│   └── *.php                   # Test files
├── composer.json               # Package dependencies
├── pint.json                   # Code style configuration
└── phpunit.xml                 # Test configuration
```

### Important Files

- **SearchConsoleClient.php**: Core client handling API interactions
- **AbstractQuery.php**: Base class for all search queries
- **SearchConsole.php (Facade)**: Main entry point for the package
- **SearchConsoleServiceProvider.php**: Laravel service registration
- **QueryMakeCommand.php**: Artisan command for generating query classes

## Coding Conventions & Best Practices

### Code Style
- Follows **Laravel Pint** with Laravel preset
- PSR-4 autoloading standards
- Unused imports are allowed (configured in pint.json)
- Method chaining for fluent interfaces

### Naming Conventions
- Classes: PascalCase (e.g., `SearchConsoleClient`)
- Methods: camelCase (e.g., `setAccessToken`)
- Properties: camelCase with typed declarations
- Interfaces: Descriptive names in `Contracts/` namespace

### Architecture Patterns
- **Facade Pattern**: `SearchConsole` facade for easy access
- **Service Provider Pattern**: Laravel service container integration
- **Abstract Factory Pattern**: Query creation and management
- **Command Pattern**: Artisan commands for code generation
- **Trait Pattern**: Model integration via `SearchConsole` trait

### Authentication Handling
- OAuth 2.0 tokens: `['access_token' => '...', 'refresh_token' => '...']`
- Service Account: JSON key file or credentials array
- Token refresh handled automatically when refresh token is available

## Sample Tasks & Copilot Prompt Guidance

### 1. Creating a New Query Class

**Prompt**: "Create a new query class for getting top pages by impressions in the last 30 days"

**Expected Structure**:
```php
<?php

namespace App\Search;

use Revolution\Google\SearchConsole\Query\AbstractQuery;

class TopPagesQuery extends AbstractQuery
{
    public function init(): void
    {
        $this->setStartDate(now()->subDays(30)->toDateString());
        $this->setEndDate(now()->toDateString());
        $this->setDimensions(['page']);
        $this->setMetrics(['impressions', 'clicks', 'ctr', 'position']);
        $this->setRowLimit(100);
        $this->setDataState('final');
    }
}
```

### 2. Implementing Model Integration

**Prompt**: "Add SearchConsole functionality to a User model with stored Google tokens"

**Expected Pattern**:
```php
use Revolution\Google\SearchConsole\Concerns\SearchConsole;

class User extends Model
{
    use SearchConsole;
    
    protected function tokenForSearchConsole(): array|string
    {
        return [
            'access_token' => $this->google_access_token,
            'refresh_token' => $this->google_refresh_token,
        ];
    }
}
```

### 3. Service Usage Examples

**Prompt**: "Show how to use the SearchConsole facade to query analytics data"

**Expected Usage**:
```php
use Revolution\Google\SearchConsole\Facades\SearchConsole;

// Set token and query
$result = SearchConsole::setAccessToken($token)
                      ->query('https://example.com/', new TopPagesQuery());

// List available sites
$sites = SearchConsole::setAccessToken($token)->listSites();
```

### 4. Testing Patterns

**Prompt**: "Create a test for a custom query class"

**Expected Test Structure**:
```php
use Tests\TestCase;
use Revolution\Google\SearchConsole\Facades\SearchConsole;

class CustomQueryTest extends TestCase
{
    public function test_custom_query_initialization()
    {
        $query = new CustomQuery();
        
        $this->assertInstanceOf(AbstractQuery::class, $query);
        // Test specific query parameters
    }
}
```

### Effective Copilot Prompts

1. **Be Specific**: "Create a query for mobile traffic data from Search Console API"
2. **Include Context**: "Following the AbstractQuery pattern, create a query that..."
3. **Mention Dependencies**: "Using the SearchConsole facade, implement a method that..."
4. **Reference Patterns**: "Like the existing SampleQuery, create a new query for..."

## Repository-Specific Guidelines

### Authentication Considerations
- Always handle token expiration with refresh tokens
- Service account emails must be added to Search Console properties
- API keys are NOT supported by Google Search Console API

### Query Development
- All queries must extend `AbstractQuery`
- Implement the `init()` method for query configuration
- Use appropriate date ranges and dimensions
- Consider API rate limits and data freshness

### Error Handling
- Google API errors are typically thrown as exceptions
- Handle authentication failures gracefully
- Validate URL parameters for Search Console properties

### Performance Best Practices
- Cache Google API responses when appropriate
- Batch multiple queries when possible
- Use appropriate row limits to avoid large responses
- Consider using data state 'final' vs 'fresh' based on needs

## Common Copilot Workflows

### Generating Query Classes
1. Use the artisan command: `php artisan make:search:query QueryName`
2. Implement the `init()` method with appropriate parameters
3. Test the query with mock data or real API calls

### Extending Functionality
1. Follow existing patterns in the codebase
2. Use the SearchConsole facade for consistent API access
3. Implement proper error handling and validation
4. Add corresponding tests

### Debugging API Issues
1. Check token validity and permissions
2. Verify Search Console property ownership
3. Review API quotas and limits
4. Validate URL formats and parameters

## Development Commands

```bash
# Install dependencies
composer install

# Run code style checks
vendor/bin/pint --test

# Fix code style issues
vendor/bin/pint

# Run tests
vendor/bin/phpunit

# Generate query class
php artisan make:search:query YourQueryName
```

## Contributing Guidelines

1. Follow Laravel Pint formatting standards
2. Write comprehensive tests for new features
3. Use meaningful commit messages
4. Ensure backward compatibility
5. Update documentation for public API changes
6. Test with both OAuth and Service Account authentication methods

---

*This guide helps GitHub Copilot understand the repository structure, patterns, and best practices for contributing to the Laravel Google SearchConsole package.*