using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Skype4COMUserProfile
{
    class Program
    {
        private static SKYPE4COMLib.Skype skype = new SKYPE4COMLib.Skype();

        [STAThread]
        static void Main(string[] args)
        {
            if (!skype.Client.IsRunning)
            {
                Environment.Exit(1);
            }

            skype.Client.OpenUserInfoDialog(args[0]);
        }
    }
}
