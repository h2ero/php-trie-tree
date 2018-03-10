# Trie Tree For PHP
## install
`composer require h2ero/php-trie-tree`
## Usage
``` php
<?php
$trie = new \h2ero\TrieTree();
$trie->add("shit");
$result = $trie->find("oh shit");
var_dump($result);
$trie->add("吃瓜");
$result = $trie->find("oh shit, 吃瓜群众");
var_dump($result);
$trie->delete("shit");
$result = $trie->find("oh shit, 吃瓜群众");
var_dump($result);
```

## 中文说明
Trie tree 的PHP实现， 用于敏感词过滤， 建议独立写为一个RPC服务。
