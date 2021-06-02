$("textarea").keydown(function(e)
{
    if (e.which == 9) //ASCII tab
    {
        e.preventDefault();
        var start = this.selectionStart;
        var end = this.selectionEnd;
        var v = $(this).val();
        if (start == end)
          {
              $(this).val(v.slice(0, start) + "\t" + v.slice(start));
              this.selectionStart = start+4;
              this.selectionEnd = start+4;
              return;
          }

        var selectedLines = [];
        var inSelection = false;
        var lineNumber = 0;
        for (var i = 0; i < v.length; i++)
        {
          if (i == start)
          {
              inSelection = true;
              selectedLines.push(lineNumber);
          }
          if (i >= end)
              inSelection = false;

          if (v[i] == "\n")
          {
              lineNumber++;
              if (inSelection)
                  selectedLines.push(lineNumber);
          }
        }
        var lines = v.split("\n");
        for (var i = 0; i < selectedLines.length; i++)
        {
            lines[selectedLines[i]] = "\t" + lines[selectedLines[i]];
        }

        $(this).val(lines.join("\n"));
    }
});
$("textarea").keypress(function(e)
{
    if (e.which == 13) // ASCII newline
    {
        setTimeout(function(that)
        {
            var start = that.selectionStart;
            var v = $(that).val();
            var thisLine = "";
            var indentation = 0;
            for (var i = start-2; i >= 0 && v[i] != "\n"; i--)
            {
                thisLine = v[i] + thisLine;
            }
            for (var i = 0; i < thisLine.length && thisLine[i] == "\t"; i++)
            {

                indentation++;
             }
             $(that).val(v.slice(0, start) + "\t".repeat(indentation) + v.slice(start));
             that.selectionStart = start+indentation;
             that.selectionEnd = start+indentation;
}, 0.01, this);
     }
});
