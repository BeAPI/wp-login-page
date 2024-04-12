#!/bin/bash
# Force the WP rewrite structure to be /%postname%/
npm run env:cli -- wp rewrite structure '/%postname%/' --hard
npm run env:tests-cli -- wp rewrite structure '/%postname%/' --hard
