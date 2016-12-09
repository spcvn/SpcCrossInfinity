#!/bin/bash
# LIFE CONCIRERGE
# daily and monthly batch for the Calculating user's points
#
# To successfully write a shell script, you have to do three things:
# - Write a script
# - Give the shell permission to execute it
# - Put it somewhere the shell can find it
#
# ◆ cronの設定方法
# 手順1. コマンド
#   > crontab -e
# 手順2. 下記を追記してください。
#   00 00 * * * /var/www/html/dev.cross-infinity.com/takeyani_batch.sh

#----------------------------------------
# 変数定義
#----------------------------------------
vtoday=`date "+%Y%m%d_%H%M%S"`

# 実行ファイルのディレクトリ
vapp_dir=/var/www/html/dev.cross-infinity.com
vmysqldump_dir=/usr/bin

# Log関連
vlog_dir=/var/www/html/dev.cross-infinity.com/log
vlog_file="Daily_batch_${vtoday}.log"

# DBbk関連
vdb_dump_dir=/var/www/html/dev.cross-infinity.com/database_backup
vdb_dump_file="takeyani_db_${vtoday}.sql"

#----------------------------------------
# 処理
#----------------------------------------
echo "START" > "${vlog_dir}/${vlog_file}"

cd ${vapp_dir}

PATH="$PATH:${vapp_dir}:${vmysqldump_dir}"

#----------------------------------------
# DBbk
#----------------------------------------
# vhost=localhost
# vuser=cross_dev
# MYSQL_PWD="92CDZMX"
# vdb=cross_infinity_dev

# echo "----------------------------------------" >> "${vlog_dir}/${vlog_file}"
# echo " DB Backup" >> "${vlog_dir}/${vlog_file}"
# echo "----------------------------------------" >> "${vlog_dir}/${vlog_file}"
# date "+%Y/%m/%d %H:%M:%S" >> "${vlog_dir}/${vlog_file}"

# mysqldump -h${vhost} -u${vuser} -p$MYSQL_PWD --databases ${vdb} >> "${vdb_dump_dir}/${vdb_dump_file}"

# if [ $? -eq 0 ]
# then
#   echo "[SUCCESS BACKUP DATABASE]" >> "${vlog_dir}/${vlog_file}"
# else
#   echo "[FAILURE BACKUP DATABASE - PLEASE CHECK LOG]" >> "${vlog_dir}/${vlog_file}"
#   exit
# fi

#----------------------------------------
# Daily batch
#----------------------------------------
# echo " " >> "${vlog_dir}/${vlog_file}"
# echo "----------------------------------------" >> "${vlog_dir}/${vlog_file}"
# echo " Daily batch" >> "${vlog_dir}/${vlog_file}"
# echo "----------------------------------------" >> "${vlog_dir}/${vlog_file}"
# date "+%Y/%m/%d %H:%M:%S" >> "${vlog_dir}/${vlog_file}"

# php index.php Daily_batch run >> "${vlog_dir}/${vlog_file}"

# if [ $? -eq 0 ]
# then
#   echo "[SUCCESS]" >> "${vlog_dir}/${vlog_file}"
# else
#   echo "[FAILURE - PLEASE CHECK LOG]" >> "${vlog_dir}/${vlog_file}"
#   exit
# fi

#----------------------------------------
# Monthly batch
#----------------------------------------
vday=`date "+%d"`
# if [ ${vday} -eq "1" ]
# then
  echo " " >> "${vlog_dir}/${vlog_file}"
  echo "----------------------------------------" >> "${vlog_dir}/${vlog_file}"
  echo " Monthly batch" >> "${vlog_dir}/${vlog_file}"
  echo "----------------------------------------" >> "${vlog_dir}/${vlog_file}"
  date "+%Y/%m/%d %H:%M:%S" >> "${vlog_dir}/${vlog_file}"

  php index.php Monthly_batch run >> "${vlog_dir}/${vlog_file}"

  if [ $? -eq 0 ]
  then
    echo "[SUCCESS]" >> "${vlog_dir}/${vlog_file}"
  else
    echo "[FAILURE - PLEASE CHECK LOG]" >> "${vlog_dir}/${vlog_file}"
    exit
  fi
# fi

echo "END [SUCCESS]" >> "${vlog_dir}/${vlog_file}"
