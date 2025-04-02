PROGRAM SarahRevere(INPUT, OUTPUT);
USES
  DOS;
VAR
  QueryString: STRING;
BEGIN {SarahRevere}
  WRITELN('Content-Type: text/plain');
  WRITELN; // Пустая строка между заголовком и телом ответа
  QueryString := GetEnv('QUERY_STRING');
  IF QueryString = 'lanterns=1'
  THEN
    WRITELN('One lantern - The British are coming by land.')
  ELSE
    IF QueryString = 'lanterns=2'
    THEN
      WRITELN('Two lanterns - The British are coming by sea.')
    ELSE
      WRITELN('Error: Invalid input.')
END. {SarahRevere}
