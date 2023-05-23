ls -l ~/.ssh/
ls -l ~/
ls -la ~/
ssh-keyscan -t rsa github.com >> ~/.ssh/known_hosts
pwd

ssh-keyscan -t rsa github.com >> ~/.ssh/known_hosts
ls -l ~/.ssh/
cat ~/.ssh/known_hosts 
ssh-keygen -q -t ed25519 -C "rpcalvo84@gmail.com" -N '' -f ~/.ssh/id_rsa <<<y
cd ~
cat .ssh/id_rsa.pub 
cat .ssh/id_rsa
ssh-keygen -q -t ed25519 -C "rpcalvo84@gmail.com" -N '' -f ~/.ssh/id_rsa <<<y
y
cat .ssh/id_rsa
cat .ssh/id_rsa.pub 
exit
exit
