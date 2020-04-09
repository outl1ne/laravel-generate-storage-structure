# Laravel Generate Storage Structure

![tests](https://github.com/optimistdigital/laravel-generate-storage-structure/workflows/tests/badge.svg)

This package generates the Laravel storage folder structure. Useful when mounting an empty directory to replace `storage/` in production or staging environments.

When running a Laravel application with an empty storage directory, you should get an error related with reading/storing files to/from `storage` directory like `ErrorException
file_put_contents(/../storage/..): failed to open stream: No such file or directory` or similar. This can be fixed by manually creating the folder structure as needed, but it's cumbersome task with automated CI/CD flows.

## Usage

```
composer require optimistdigital/laravel-generate-storage-structure
```

Create `app/`, `framework/` and `logs/` directories into the current directory:

```
generate-storage-structure
```

Create `app/`, `framework/` and `logs/` directories into `/storage` directory:

```
generate-storage-structure --storage-path=/storage
```