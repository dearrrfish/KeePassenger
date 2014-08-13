KeePassenger
============

Alfred workflow for KeePass databases, with a node-based service api server as support.

## Dependencies

- [KSAPI-Server](https://github.com/dearrrfish/keepass-service-node)

## Usage

- Start KSAPI server first.
- `ks` - search by formatted query string, e.g. `aws title:google url:amazon.com`
- `kset show/title_only/ccdelay/ksapi/secret` - settings
- `ku` - update db cache on server side

## TODO

- db configuration on workflow side
- db entries browsing
- more customized options
- ...