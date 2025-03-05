PROGRAM PrintEnvironmentVariables(INPUT, OUTPUT);
USES
  DOS;
VAR
  RequestMethod: String;
  QueryString: String;
  ContentLength: String;
  UserAgent: String;
  Host: String;
BEGIN {PrintEnvironmentVariables}
  WRITELN('Content-Type: text/html');
  WRITELN; // ������ ������ ����� ���������� � ����� ������
  // �������� �������� ���������� ���������
  RequestMethod := GetEnv('REQUEST_METHOD');
  QueryString := GetEnv('QUERY_STRING');
  ContentLength := GetEnv('CONTENT_LENGTH');
  UserAgent := GetEnv('HTTP_USER_AGENT');
  Host := GetEnv('HTTP_HOST');
  // ������� �������� ���������� ���������
  WRITELN('REQUEST_METHOD: ', RequestMethod);
  WRITELN('QUERY_STRING: ', QueryString);
  WRITELN('CONTENT_LENGTH: ', ContentLength);
  WRITELN('HTTP_USER_AGENT: ', UserAgent);
  WRITELN('HTTP_HOST: ', Host);
  WRITELN('<img src="https://media1.tenor.com/m/edntMFMKAOsAAAAd/pudge-����.gif"/>')
END. {PrintEnvironmentVariables}