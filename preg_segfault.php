<?php

if (preg_match('/./', 'a')) echo "pre-fork works\n";

$pid = pcntl_fork();
if ($pid == -1) {
    die('fail');
} elseif ($pid) {
    if (preg_match('/./', 'a')) echo "parent works\n";
    pcntl_wait($status);
    if (pcntl_wifsignaled($status) && pcntl_wtermsig($status) == SIGSEGV) {
        echo "child process segfaulted\n";
        exit(1);
    }
} else {
    if (preg_match('/./', 'a')) echo "child works\n";
}
