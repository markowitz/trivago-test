# trivago-test

This project converts different data types to csv format.

## installation

clone the repo

```bash
git clone git@github.com:markowitz/trivago-test.git
```

```bash
run composer install
```

## usage

```bash
./bin/console trivago:convert filename.json (whatever format you want to convert)
```

## running tests

```bash
composer test
```

## Improve Data Quality

validation errors are stored in the /var/log/data_validation.log. To see the issues related to data validation and quality.

## Things to note

add files to be convert in the var/in directory.

