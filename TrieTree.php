<?php
/**
 * File: TrieTree.php
 *
 * @author h2ero <122750707@qq.com> 
 * @date 2018-03-10 10:21:56
 */

namespace h2ero;


/**
 * Class TrieTree .
 */
class TrieTree
{
    public static $trieTree = array();
    public function __construct()
    {
    }
    public function splitWord($word)
    {
        preg_match_all("/./ismu", $word, $charList);
        return $charList[0];
    }

    public function add($word)
    {
        $charList = $this->splitWord($word);
        $len = count($charList);
        for ($i = 0; $i < $len; $i++) {
            if ($i == 0) {
                if (!isset(static::$trieTree[$charList[$i]])) {
                    static::$trieTree[$charList[$i]] = [];
                }
                $childTrieTree = &static::$trieTree[$charList[$i]];
            } else {
                if (!isset($childTrieTree[$charList[$i]])) {
                    $childTrieTree[$charList[$i]] = [];
                }
                $childTrieTree = &$childTrieTree[$charList[$i]];
            }
        }
    }

    public function delete($word)
    {
        $charList = $this->splitWord($word);
        $len = count($charList);
        $deleteTrie = $charList;
        for ($i = 0; $i < $len; $i++) {
            if ($i == 0) {
                if (count(static::$trieTree[$charList[$i]]) == 1) {
                    $deleteTrie[$i] = 1;
                }
                $childTrieTree = &static::$trieTree[$charList[$i]];
            } else {
                if (count($childTrieTree[$charList[$i]]) <= 1) {
                    $deleteTrie[$i] = 1;
                } elseif (count($childTrieTree[$charList[$i]]) >= 2) {
                    $deleteTrie = array_fill(0, count($deleteTrie), 0);
                }
                $childTrieTree = &$childTrieTree[$charList[$i]];
            }
        }

        for ($i = 0; $i < $len; $i++) {
            if ($i == 0) {
                if ($deleteTrie[$i] == 1) {
                    unset(static::$trieTree[$charList[$i]]);
                    break;
                }
                $childTrieTree = &static::$trieTree[$charList[$i]];
            } else {
                if ($deleteTrie[$i] == 1) {
                    unset($childTrieTree[$charList[$i]]);
                    break;
                }
                $childTrieTree = &$childTrieTree[$charList[$i]];
            }
        }
    }

    public function find($text)
    {
        $charList = $this->splitWord($text);
        $len = count($charList);
        $foundWordList = array();
        for ($i = 0; $i < $len; $i++) {
            $childTrieTree =  static::$trieTree;
            $foundWord = array();
            $firstIndex = -1;
            findChild:
            foreach ($childTrieTree as $char => $childChildTrieTree) {
                if (!isset($charList[$i])) {
                    break;
                }
                if ($char == $charList[$i]) {
                    if ($firstIndex ===  -1) {
                        $firstIndex = $i;
                    }
                    $i++;
                    $foundWord[] = $char;
                    $childTrieTree = $childChildTrieTree;
                    if (empty($childTrieTree)) {
                        $foundWordList[] = implode("", $foundWord);
                    }
                    goto findChild;
                }
            }
            if ($firstIndex !== -1) {
                $i = $firstIndex;
            }
        }
        if ( ! empty($foundWordList)) {
            return $foundWordList;
        }
    }
    public function getAll()
    {
        return static::$trieTree;
    }
}
