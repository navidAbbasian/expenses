#!/bin/sh
git filter-branch --env-filter \
    'if [ $GIT_COMMIT = 3b7ed863c16383d7dfeb126437cc25e29c7f240e ]
     then
         export GIT_AUTHOR_DATE="Sun May 12 10:38:53 2024 +0330"
         export GIT_COMMITTER_DATE="Sun May 12 10:38:53 2024 +0330"
     fi'
