PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES
  DOS;

FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  QueryString, ParamName, ParamValue: STRING;
  StartPos, EndPos, EqualPos: INTEGER;
BEGIN
  GetQueryStringParameter := '';
  QueryString := GetEnv('QUERY_STRING');
  IF QueryString <> '' 
  THEN
    BEGIN
      StartPos := POS(Key + '=', QueryString);
      IF StartPos > 0 THEN
      BEGIN
        EqualPos := StartPos + LENGTH(Key) + 1;
        ParamValue := Copy(QueryString, EqualPos, MAXINT);
        EndPos := POS('&', ParamValue);
        IF EndPos > 0 THEN
        BEGIN
          ParamValue := Copy(ParamValue, 1, EndPos - 1)
        END;
        GetQueryStringParameter := ParamValue
      END
    END
END;

BEGIN {WorkWithQueryString}
  WRITELN('Content-Type: text/plain');
  WRITELN; 
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'));
END. {WorkWithQueryString}
