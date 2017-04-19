#!/usr/bin/env bash

wp scaffold taxonomy difficulty --post_types=post --label="Difficulty Rating" --textdomain=diy-time-and-materials --plugin=DIY-time-and-materials
wp scaffold taxonomy time --post_types=post --label="Time Required" --textdomain=diy-time-and-materials --plugin=DIY-time-and-materials
wp scaffold taxonomy materials --post_types=post --label="Materials Cost" --textdomain=diy-time-and-materials --plugin=DIY-time-and-materials