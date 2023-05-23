FROM jenkins/jenkins:lts

SHELL ["/bin/bash", "-c"]

# Para que se pueda conectar a un repositorio de github para hacer sus tareas:
RUN mkdir ~/.ssh
RUN ssh-keyscan -t rsa github.com >> ~/.ssh/known_hosts

# Para generar la clave SSH que requiere github:
## -q para que sea silencioso y no pida nada al usuario
## -N para asignarle la passphrase
## -f para indicarle donde guardar la clave
RUN ssh-keygen -q -t ed25519 -N '' -f ~/.ssh/id_rsa <<<y
# Una vez lanzado el contenedor, ejecutar:
## docker exec -it _nombre_de_contendor_ cat /var/jenkins_home/.ssh/id_rsa.pub
# para obtener la clave pública que se debe meter en la cuenta de github
# Crear la clave aquí hace que cada vez que se borre la imagen de jenkins, haya que actualizar el ssh en github, así que TAL VEZ SEA MALA IDEA y debería crearla el usuario en su equipo "Real"

