<?php
const FILE_NAME = "access_log.log";
const NEW_LINE = "\n";
const FIND_URL = '#http:\/\/\S+#';
const FIND_TRAFFIC = '#\"\s[0-9]{0,3}\s[0-9]{0,9}\s\"#';
const FIND_TRAFFIC_WITHOUT_QUOTES = '#[0-9]{0,9}\s#';
