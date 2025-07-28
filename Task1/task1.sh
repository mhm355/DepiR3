#! /bin/bash

# Solution of Task 1

pwd # Print working directory

# Create Directory

mkdir -v  DepiDir1 # Create DepiDir1 directory
mkdir -pv  DepiDir2/DepiDir3 # Create DepiDir2 and DepiDir3 inside it

# Preview Data in File

cat /etc/hostname
 

# File Management

touch ~/Desktop/DepiR3/task1/DepiFile1
echo "Hello Depi" > DepiFile1 
#vim DepiFile1 

cp -v DepiFile1 DepiDir1
mv -v  DepiFile1 DepiDir2/DepiFile2


# Searching in Files

grep -n "mhm" /etc/passwd
systemctl status docker | grep -i active

find ~ -name "Depi*" -type f  
find ~ -name "Depi*" -type d

# date 

echo time is $(date +%r)

# change permissions 
touch DepiFile2 DepiFile3
ls -l DepiFile2 DepiFile3
chmod 764 DepiFile3
chmod u+rw,g+r,o-rwx DepiFile2
ls -l DepiFile2 DepiFile3

# add , switch and delete user 

sudo useradd -d /home/Mahmoud -s /bin/bash Mahmoud
echo "Mahmoud:1234" | sudo chpasswd

tail -n 3 /etc/passwd

sudo userdel Mahmoud

tail -n 3 /etc/passwd

# alaias 

alias name=whoami
alias 
name
unalias name
alias 

ls 
rm -v DepiFile2 DepiFile3
rm -rv DepiDir1 DepiDir2

ls
# End of Task 1

