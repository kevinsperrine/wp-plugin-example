#!/bin/sh

find . -name '{{PLUGIN_NAME}}' -type d -exec bash -c 'mv "$1" "TestPlugin"' -- {} \;

# find -iname "{{PLUGIN_NAME}}" -type d -exec mv  {} \;