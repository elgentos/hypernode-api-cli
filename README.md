# hypernode-api-cli

Standalone PHAR implementation of the Hypernode API PHP client library.

Set `HYPERNODE_API_TOKEN` environment variable with the key of the Hypernode you want to run these commands against. You can find the key on your Hypernode in ``/etc/hypernode/hypernode_api_token`.

## Usage

```
  Hypernode-api-cli

  USAGE: hypernode-api-cli <command> [options] [arguments]

  brancher:create Create a new Brancher node
  brancher:delete Delete/cancel a Brancher node
  brancher:list   List all Brancher nodes for a given Hypernode
```

### brancher:create

```
Description:
  Create a new Brancher node

Usage:
  brancher:create [options] [--] <hypernode>

Arguments:
  hypernode                              

Options:
      --label[=LABEL]                    Add labels to your Brancher node (comma-separated, optional)
      --clear-services[=CLEAR-SERVICES]  Clear the data for provided service(s) when creating the Brancher instance. Useful when you don't want to run the production cron or supervisor. Can also be useful if you want to supply your own anonymized database. Possible options: cron, elasticsearch, mysql, supervisor (comma-separated, optional)
```

### brancher:delete

```
Description:
  Delete/cancel a Brancher node

Usage:
  brancher:delete <hypernode>

Arguments:
  hypernode 
```

### brancher:list

```
Description:
  List all Brancher nodes for a given Hypernode

Usage:
  brancher:list [options] [--] <hypernode>

Arguments:
  hypernode              

Options:
      --output[=OUTPUT]  Output format (json, default: table)
```
