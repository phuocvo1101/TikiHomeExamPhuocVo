# Home Test Tiki
# input param in command line
# (-a: action, -e: email, -p: name product, -q: qty -r: remove (if value r = 1))

# Add 2 Apple product to Cart ( run commandline)
php index.php -a caseTest -e john.doe@example.com -p Apple -q 2

# Add 2 Orange product to Cart ( run commandline)
php index.php -a caseTest -e john.doe@example.com -p Orange -q 1

# Remove 1 Apple product from Cart ( run commandline)
php index.php -a caseTest -e john.doe@example.com -p Apple -q 1 -r 1

# check shoppingCart Total price ( run commandline)
php index.php -a shoppingCart -e john.doe@example.com

# empty shoppingCart ( run commandline)
php index.php -a emptyCart -e john.doe@example.com

# Test case1: run comand line
- php index.php -a emptyCart -e john.doe@example.com
- php index.php -a caseTest -e john.doe@example.com -p Apple -q 2
- php index.php -a caseTest -e john.doe@example.com -p Orange -q 1
- php index.php -a shoppingCart -e john.doe@example.com
- php index.php -a emptyCart -e john.doe@example.com

# Test case2: run comand line
- php index.php -a caseTest -e john.doe@example.com -p Apple -q 3
- php index.php -a caseTest -e john.doe@example.com -p Apple -q 1 -r 1
- php index.php -a shoppingCart -e john.doe@example.com
- php index.php -a emptyCart -e john.doe@example.com
