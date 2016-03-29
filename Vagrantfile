require "json"

settings = JSON.parse(File.read("./box.json"))

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

	config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'"

	config.ssh.forward_agent = true

	# Box settings
	config.vm.box = settings["box"]

	# Configure private network
	config.vm.network "private_network", ip: settings["ip_address"]

	# Configure box on VirtualBox
	config.vm.provider "virtualbox" do |vb|
		unless settings["name"].nil?
			vb.name = settings["name"]
		end

		vb.customize ["modifyvm", :id, "--memory", settings["memory"]]
		vb.customize ["modifyvm", :id, "--cpus", settings["cpus"]]
		vb.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
		vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
		vb.customize ["modifyvm", :id, "--ostype", settings["os_type"]]
	end

	default_ports = {
		80 => 8000,
		443 => 44300,
		3306 => 33060,
		5432 => 54320
	}

	unless settings["public_key"].nil?
		if File.exists? File.expand_path(settings["public_key"])
			config.vm.provision "shell" do |s|
				s.inline = "echo $1 | grep -xq \"$1\" /home/vagrant/.ssh/authorized_keys || echo $1 | tee -a /home/vagrant/.ssh/authorized_keys"
				s.args = [File.read(File.expand_path(settings["public_key"]))]
			end
		end
	end

	if settings.include? "keys"
		settings["keys"].each do |key|
			config.vm.provision "shell" do |s|
				s.privileged = false
				s.inline = "echo \"$1\" > /home/vagrant/.ssh/$2 && chmod 600 /home/vagrant/.ssh/$2"
				s.args = [File.read(File.expand_path(key)), key.split("/").last]
			end
		end
	end

	# Sync folders
	if settings.include? "folders"
		settings["folders"].each do |folder|
			config.vm.synced_folder folder["map"], folder["to"]
		end
	end

	# Provision the machine
	unless settings["provision"].nil?
		config.vm.provision :shell, path: settings["provision"]
	end
end
