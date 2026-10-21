import subprocess
import os
import re

PHP_EXE = r"C:\xampp\php\php.exe"
WORKSPACE_DIR = r"e:\Sistem Informasi Klinik Zeni"

php_files = [
    "index.php",
    "pasien.php",
    "dokter.php",
    "apotek.php",
    "kasir.php",
    "admin.php",
    "antrian-tv.php",
    "daftar.php",
    "login.php"
]

def compile_all():
    for php_file in php_files:
        src_path = os.path.join(WORKSPACE_DIR, php_file)
        if not os.path.exists(src_path):
            print(f"Skipping {php_file}, file not found.")
            continue
        
        target_html = php_file.replace(".php", ".html")
        dst_path = os.path.join(WORKSPACE_DIR, target_html)
        
        print(f"Compiling {php_file} -> {target_html}...")
        try:
            res = subprocess.run(
                [PHP_EXE, src_path],
                cwd=WORKSPACE_DIR,
                capture_output=True,
                text=True,
                encoding="utf-8"
            )
            
            if res.returncode == 0:
                html_output = res.stdout
                
                # Replace internal links: .php -> .html
                # e.g., href="pasien.php" -> href="pasien.html", action="login.php" -> action="login.html"
                html_output = re.sub(r'href=([\'"])([^#\'"]+)\.php(\?[^\'"]*)?([\'"])', r'href=\1\2.html\3\4', html_output)
                html_output = re.sub(r'action=([\'"])([^#\'"]+)\.php(\?[^\'"]*)?([\'"])', r'action=\1\2.html\3\4', html_output)
                html_output = re.sub(r'window\.location\.href\s*=\s*([\'"])([^#\'"]+)\.php(\?[^\'"]*)?([\'"])', r'window.location.href=\1\2.html\3\4', html_output)
                html_output = re.sub(r'window\.location\s*=\s*([\'"])([^#\'"]+)\.php(\?[^\'"]*)?([\'"])', r'window.location=\1\2.html\3\4', html_output)
                html_output = re.sub(r'url\s*:\s*([\'"])([^#\'"]+)\.php(\?[^\'"]*)?([\'"])', r'url:\1\2.html\3\4', html_output)
                
                with open(dst_path, "w", encoding="utf-8") as f:
                    f.write(html_output)
                print(f"Successfully created {target_html} ({len(html_output)} bytes)")
            else:
                print(f"Error compiling {php_file}: {res.stderr}")
        except Exception as e:
            print(f"Exception compiling {php_file}: {e}")

if __name__ == "__main__":
    compile_all()
