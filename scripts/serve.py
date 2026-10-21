import os
import re
from http.server import HTTPServer, SimpleHTTPRequestHandler

PORT = 8080
BASE_DIR = os.path.dirname(os.path.abspath(__file__))

def render_php_file(filepath):
    """
    Lightweight PHP template renderer for local viewing without XAMPP.
    Recursively resolves require/include statements and basic PHP variables.
    """
    if not os.path.exists(filepath):
        return None
        
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Extract $title variable if defined
    title_match = re.search(r'\$title\s*=\s*["\']([^"\']+)["\'];', content)
    page_title = title_match.group(1) if title_match else "KLINIK PRATAMA PUSDIKZI"

    # Replace require / require_once statements recursively
    def replace_include(match):
        inc_path = match.group(1).replace('__DIR__', BASE_DIR).replace("'", "").replace('"', "").replace(' . ', '').strip()
        # Clean path formatting
        inc_path = os.path.normpath(os.path.join(BASE_DIR, inc_path.lstrip('/\\')))
        if os.path.exists(inc_path):
            with open(inc_path, 'r', encoding='utf-8') as inc_f:
                inc_content = inc_f.read()
                # Remove opening/closing PHP tags inside partials if pure html
                return inc_content
        return f"<!-- Include Not Found: {inc_path} -->"

    # Match require_once / require / include
    include_regex = r'<\?php\s*(?:require_once|require|include_once|include)\s+([^;]+);\s*\?>'
    
    # Perform replacement loop until all nested includes are resolved
    for _ in range(5):
        content = re.sub(include_regex, replace_include, content)

    # Clean remaining php tags and title echoes
    content = re.sub(r'<\?php\s*echo\s+\$title[^;]*;\s*\?>', page_title, content)
    content = re.sub(r'<\?php[\s\S]*?\?>', '', content)
    
    return content

class CleanPhpRequestHandler(SimpleHTTPRequestHandler):
    def do_GET(self):
        # Default route to index.php
        req_path = self.path.split('?')[0]
        if req_path in ('/', ''):
            req_path = '/index.php'
            
        full_path = os.path.normpath(os.path.join(BASE_DIR, req_path.lstrip('/\\')))
        
        # If accessing a PHP file, render it dynamically
        if req_path.endswith('.php') or (not os.path.splitext(req_path)[1] and os.path.exists(full_path + '.php')):
            if not req_path.endswith('.php'):
                full_path += '.php'
                
            rendered_html = render_php_file(full_path)
            if rendered_html:
                self.send_response(200)
                self.send_header('Content-Type', 'text/html; charset=utf-8')
                self.end_headers()
                self.wfile.write(rendered_html.encode('utf-8'))
                return
            else:
                self.send_error(404, "PHP File Not Found")
                return

        # Fallback to standard static file serving (css, js, images)
        return super().do_GET()

if __name__ == '__main__':
    print(f"[OK] Server Lokal Klinik Pusdikzi Berjalan di: http://localhost:{PORT}")
    print("Mendukung rendering file .php dan partials includes/ secara otomatis tanpa XAMPP!")
    httpd = HTTPServer(('0.0.0.0', PORT), CleanPhpRequestHandler)
    try:
        httpd.serve_forever()
    except KeyboardInterrupt:
        print("\nServer dihentikan.")
