
from json import loads as jsonDecode
from os import makedirs
from os import path

def createControllerFileContent(name):
    nameCap = name.capitalize()
    content = """<?php
namespace app\\app\\controller;

use think\\Controller;
use app\\app\\model\\Utils;
use app\\app\\model\\Constant;

class {0} extends Controller {{

    public function index() {{
        if (Utils::userAlreadyLogin()) {{
            return view();
        }} else {{
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }}
    }}
    
}}

    """.format(nameCap)
    return content

def createViewFileContent(name):
    content = """{{[extend name="common@base" /]}}
{{[block name="title"]}}{{[/block]}}
{{[block name="css"]}}{{[/block]}}
{{[block name="content"]}}{{[/block]}}
{{[block name="js"]}}
<script>
    update_navs('{0}');
</script>
{{[/block]}}

    """.format(name)
    return content

def create(navs, pageControllerPath, pageViewPath):
    for nav in navs:
        if nav['pull']:
            create(nav['son'], pageControllerPath, pageViewPath)
        else:
            name = nav['name']
            nameCap = name.capitalize()
            controllerFileName = "{0}{1}.php".format(pageControllerPath, nameCap)
            viewPathName = "{0}{1}".format(pageViewPath, name)
            viewFileName = "{0}/index.html".format(viewPathName)
            if not path.exists(controllerFileName):
                controllerFileContent = createControllerFileContent(name)
                viewFileContent = createViewFileContent(name)
                controllerFile = open(controllerFileName, "w", encoding='UTF-8')
                if not path.exists(viewPathName):
                    makedirs(viewPathName)
                viewFile = open(viewFileName, "w", encoding='UTF-8')
                controllerFile.write(controllerFileContent)
                viewFile.write(viewFileContent)
                controllerFile.close()
                viewFile.close()

def main():
    nav_json = open("pyScript/nav.json", encoding='UTF-8')
    navs = jsonDecode(nav_json.read())
    nav_json.close()
    pageControllerPath = "www/application/app/controller/"
    pageViewPath = "www/application/app/view/"
    create(navs, pageControllerPath, pageViewPath)

if __name__ == "__main__":
    main()
