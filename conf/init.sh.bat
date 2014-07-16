cd ..
git config -f .gitmodules submodule.php-yaoi.branch master
git submodule update --recursive --init
git submodule foreach --recursive git checkout master