#!/bin/bash

#
BACKUPPATH=/opt/www/wpsite.com/wordpress
BACKUPFILESPATH=/opt/www/wpsite.com/wp_backupdir

SITELIST=/tmp/sitelist-wp-sites.sdata
UMASK=002
FILE_DATE=`date '+%Y%m%d'`
WDT=`date '+%Y%m%d%H%M'`
LF_DIR=/opt/www/wpsite.com
LF=$LF_DIR/wp-backup-$FILE_DATE.log
mkdir -p $LF_DIR
chmod 777 /opt/www/wpsite.com
touch $LF
chmod 644 $LF

function LogStart
{
        echo "====== Log Start =========" >> $LF
        echo "Time: `date`" >> $LF
        echo " " >> $LF
}
function LogEnd
{
        echo " " >> $LF
        echo "Time: `date`" >> $LF
        echo "====== Log End   =========" >> $LF
}

function LogMsg
{
        echo "`date '+%Y-%m-%d|%H:%M:%S|'`OK|$1" >> $LF
}

function LogError
{
        echo "`date '+%Y-%m-%d|%H:%M:%S|'`ERROR|$1" >> $LF
}

function LogCritical
{
        echo "`date '+%Y-%m-%d|%H:%M:%S|'`CRITICAL|$1" >> $LF
}

function CheckStatusCode
{
	if [ $? -eq 0 ]
		then
            LogMsg "Command exit code OK"
		else
            LogError "Command terminated with errors"
	fi

}


#----------------------------------------
# Files backup
#----------------------------------------
LogStart
	if [ ! -d ${BACKUPFILESPATH} ]
	then
		mkdir -p ${BACKUPFILESPATH}
		LogMsg "Creating FilesBackup Dir"
	fi

    tar -czvf wordpress-${WDT}.tar.gz ${BACKUPPATH}/wordpress
    CheckStatusCode

    mv wordpress-${WDT}.tar.gz ${BACKUPFILESPATH}
	CheckStatusCode
	
    LogMsg "Archive can be found in  [${BACKUPFILESPATH}]"
    LogEnd



#----------------------------------------
# Database backup
#----------------------------------------

	LogStart
	if [ ! -d ${BACKUPPATH} ]
	then
		mkdir -p ${BACKUPPATH}
		LogMsg "Creating DB-Backup Dir"
	fi
	find /opt/www/wpsite.com/wordpress -type f -name wp-config.php -print > ${SITELIST}
	cnt=0
	while read LINE
	do
		FDT=`date '+%Y%m%d%H%M'`
		FD=`date '+%Y%m%d'` 

        DBNAME=`cat ${LINE} | grep DB_NAME | cut -d \' -f 4`
        DBUSER=`cat ${LINE} | grep DB_USER | cut -d \' -f 4`
        DBPWD=`cat ${LINE} | grep DB_PASSWORD | cut -d \' -f 4`


		DBBACKUPFILE=${BACKUPPATH}/$DBNAME-${FDT}.sql
		#tstcmd="mysql -u ${DBUSER} -p${DBPWD} $DBNAME -e 'show tables;'"
		#$tstcmd > /dev/null
		if [ $? -eq 0 ]
		then
			LogMsg " "
			LogMsg "Database [${DBNAME}]"
			LogMsg "Virtual Host [${LINE}]"
			LogMsg "Backup File  [${DBBACKUPFILE}]"
			cmd="mysqldump -u ${DBUSER} -p${DBPWD} $DBNAME --no-tablespaces"
			$cmd > $DBBACKUPFILE 
			gzip $DBBACKUPFILE 
		else
			LogError "ERROR - Unable to access Database ${DBNAME} using ${DBUSER}"
		fi
		((cnt++))
	done < ${SITELIST}
	LogMsg "Found ${cnt} sites to backup."
	ls -la ${BACKUPPATH}/*${FD}* >> $LF
	rm -f ${SITELIST}
	LogEnd
#
