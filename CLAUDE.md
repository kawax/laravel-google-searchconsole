# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Common Commands

```bash
# Code quality and testing
composer lint           # Run Laravel Pint (code style formatting)
composer test           # Run PHPUnit tests with coverage
composer test -- --filter=TestName  # Run specific test

# Workbench development (Orchestra Testbench)
composer build          # Build workbench Laravel application
composer serve          # Serve workbench application at http://localhost:8000
composer clear          # Clear and rebuild workbench

# Generate query classes
php artisan make:search:query QueryName  # Creates App\Search\QueryName class
```

## Architecture Overview

This is a Laravel package that provides Google Search Console API integration with two authentication methods:

### Core Components

**SearchConsoleClient** - Main API client implementing Factory contract
- Handles OAuth 2.0 and Service Account authentication
- Provides `query()` and `listSites()` methods
- Uses Google_Service_Webmasters internally

**AbstractQuery** - Base class for all search queries
- Extends Google's SearchAnalyticsQueryRequest
- Child classes must implement `init()` method to configure query parameters
- Located in `src/Query/` directory

**WithSearchConsole Trait** - Model integration
- Requires `tokenForSearchConsole()` method implementation
- Provides auto-authenticated `searchconsole()` method
- Used for per-user Google authentication

### Laravel Integration Points

- **Facade**: `SearchConsole` provides static access
- **Service Provider**: Registers scoped binding and commands
- **Artisan Command**: `make:search:query` generates query classes in `App\Search` namespace

## Authentication Patterns

**OAuth 2.0**: Token array format `['access_token' => '...', 'refresh_token' => '...']`
**Service Account**: JSON credentials file or array, requires service account email added to Search Console properties

## Testing Setup

Uses Orchestra Testbench Workbench for package development:
- Test environment configured in `testbench.yaml`
- Service account credentials via `GOOGLE_APPLICATION_CREDENTIALS` or `GOOGLE_APPLICATION_CREDENTIALS_JSON`
- OAuth testing via mock tokens in TestCase setup

## Development Notes

- All query classes extend `AbstractQuery` and implement `init()` method
- Service account authentication preferred for server-side applications
- API requires proper authentication - API keys not supported
- Workbench provides full Laravel app for interactive development
- Package excludes providers, contracts, and commands from test coverage